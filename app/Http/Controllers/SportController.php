<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Price;
use App\Models\Sport;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class SportController extends Controller
{
    public function index()
    {

        $all_sport = Sport::withoutTrashed()->with(['category', 'price'])->orderBy('updated_at', 'desc')->paginate(10);

        return view('sport')->with('sports', $all_sport);
    }

    public function delete(Request $request, $id)
    {
        Sport::where('id', $id)->delete();
        $request->session()->put('message', 'Deleted Successfully');
        return Redirect::to('sports');
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
        $sport = Sport::where('id', $id)->with(['category', 'price'])->first();
        $category = Category::get();
        $prices = Price::get();
        $images = Image::where('sport_id', $id)->get();

        return view('edit_sport')->with('sport', $sport)->with('category', $category)->with('prices', $prices)->with('images', $images);
    }
    public function save(Request $request)
    {
        $image_path = "";

        $get_image = $request->file('image');

        if ($get_image) {
            $image_path = time() . '_' . $get_image->getClientOriginalName();
            $get_image->move('uploads', $image_path);
        }


        $sport = new Sport;

        $sport->uuid = 11;
        $sport->name = $request->name;
        $sport->image_path = $image_path;
        $sport->describe = $request->describe;
        $sport->price_id = $request->price_id;
        $sport->category_id = $request->category_id;

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
        $sport = Sport::findOrFail($request->id);
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
