<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Price;
use App\Models\Sport;
use Faker\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SportController extends Controller
{
    public function index()
    {
        if (Gate::allows('show-sports') == 'admin') {
            $all_sport = Sport::withoutTrashed()->with(['category', 'price', 'users'])->sortable()->paginate(10);
            return view('sport')->with('sports', $all_sport);
        } elseif (Gate::allows('show-sports')) {
            $all_sport = Sport::withoutTrashed()->where('user_id', '=', Auth::user()->id)->with(['category', 'price', 'users'])->sortable()->paginate(10);
            return view('sport')->with('sports', $all_sport);
        } else {
            $all_sport = Sport::withoutTrashed()->where('user_id', '=', 10000000)->with(['category', 'price', 'users'])->sortable()->paginate(10);
            return view('sport')->with('sports', $all_sport);
        }
    }

    public function delete(Request $request, $id)
    {
        $sport = Sport::where('id', $id)->first();
        if (Gate::allows('show-sports', $sport->user_id)) {
            Sport::where('id', $id)->delete();
            $request->session()->put('message', 'Deleted Successfully');
            return Redirect::to('sports');
        } else {
            Session::put('message', "You don't have permision");
            Redirect::back();
        }
    }

    public function getSportSearch(Request $request)
    {
        if ($request->has('name')) {
            $name = $request->name;
            $sports = Sport::with(['category', 'price'])->where('name', 'LIKE', '%' . $request->name . '%')
                ->orwhereHas('category', function (Builder $query) use ($name) {
                    $query->where('name', 'LIKE', '%' . $name . '%');
                })
                ->orWhere('updated_at', 'LIKE', '%' . $request->name . '%')
                ->paginate(10);
        }
        return view('sport')->with('sports', $sports);
    }

    public function detail($id)
    {
        $sport = Sport::where('id', $id)->with(['category', 'price'])->first();
        $images = Image::where('sport_id', $id)->get();
        return view('sport_detail')->with('sport', $sport)->with('images', $images);
    }

    public function add_sport()
    {
        $category = Category::get();
        $prices = Price::get();
        return view('add_sport')->with('category', $category)->with('prices', $prices);
    }

    public function edit_sport($id)
    {
        $sport = Sport::where('id', $id)->first();
        if (Gate::allows('show-sports', $sport->user_id)) {
            $sport = Sport::where('id', $id)->with(['category', 'price'])->first();
            $category = Category::get();
            $prices = Price::get();
            $images = Image::where('sport_id', $id)->get();

            return view('edit_sport')->with('sport', $sport)->with('category', $category)->with('prices', $prices)->with('images', $images);
        } else {
            Session::put('message', "You don't have permision");
            Redirect::back();
        }
    }

    public function save(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'category_id' => 'required',
            'price_id' => 'required',
            'image' => 'mimes:jpg,jpeg,png,gif|max:1024',
            'images.*' => 'mimes:jpg,jpeg,png,gif|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect('add-sport')
                ->withErrors($validator)
                ->withInput();
        }

        $image_path = "";

        $get_image = $request->file('image');

        if ($get_image) {
            $image_path = time() . '_' . $get_image->getClientOriginalName();
            $get_image->move('uploads', $image_path);
        }
        $faker = Factory::create();
        $sport = new Sport;

        $sport->uuid = $faker->uuid();
        $sport->name = $request->name;
        $sport->image_path = $image_path;
        $sport->describe = $request->describe;
        $sport->price_id = $request->price_id;
        $sport->category_id = $request->category_id;
        $sport->user_id =  Auth::user()->id;

        $sport->save();

        if ($request->hasFile("images")) {
            $files = $request->file("images");
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(\public_path("/uploads"), $imageName);

                $image = new Image;
                $image->sport_id = $sport->id;
                $image->image_path = $imageName;
                $image->title = "lorem";

                $image->save();
            }
        }
        return Redirect::to('sports');
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'category_id' => 'required',
            'price_id' => 'required',
            'image' => 'mimes:jpg,jpeg,png,gif|max:1024',
            'images.*' => 'mimes:jpg,jpeg,png,gif|max:1024',
        ]);
        $sport = Sport::findOrFail($request->id);
        $sport->name = $request->name;
        $sport->describe = $request->describe;
        $sport->price_id = $request->price_id;
        $sport->category_id = $request->category_id;
        if ($request->hasFile("image")) {
            if (File::exists("uploads/" . $sport->image_path)) {
                File::delete("uploads/" . $sport->image_path);
            }
            $file = $request->file("image");
            $sport->image_path = time() . "_" . $file->getClientOriginalName();
            $file->move(\public_path("/uploads"), $sport->image_path);
        }

        $sport->save();

        if ($request->hasFile("images")) {
            $files = $request->file("images");
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(\public_path("/uploads"), $imageName);

                $image = new Image;
                $image->sport_id = $sport->id;
                $image->image_path = $imageName;
                $image->title = "lorem";

                $image->save();
            }
        }

        return Redirect::to('sports');
    }

    public function deleteimage($id)
    {
        $images = Image::findOrFail($id);
        if (File::exists("uploads/" . $images->image_path)) {
            File::delete("uploads/" . $images->image_path);
        }

        Image::find($id)->delete();
        return back();
    }

    public function deletecover($id)
    {
        $cover = Sport::findOrFail($id)->image_path;
        if (File::exists("uploads/" . $cover)) {
            File::delete("uploads/" . $cover);
        }
        return back();
    }
}
