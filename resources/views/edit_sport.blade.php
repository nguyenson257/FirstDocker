@extends('layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h4>Chỉnh sửa Sport</h4>
                </div>
                <div class="card-body row">
                    <div class="col-lg-4">
                        <p>Hình ảnh chính:</p>
                        <form action="/deletecover/{{ $sport->id }}" method="post">
                            <button class="btn text-danger">X</button>
                            @csrf
                            @method('delete')
                        </form>
                        <img src="{{URL::to('uploads/'.$sport->image_path)}}" class="img-responsive" style="max-height: 100px; max-width: 150px;" alt="" srcset="">
                        <br>
                        @if (!empty($images))
                        <p>Hình ảnh mô tả:</p>
                        @foreach ($images as $key => $img)
                        <form action="/deleteimage/{{ $img->id }}" method="post">
                            <button class="btn text-danger">x</button>
                            @csrf
                            @method('delete')
                        </form>
                        <img src="{{URL::to('uploads/'.$img->image_path)}}" class="img-responsive" style="max-height: 100px; max-width: 150px;" alt="" srcset="">
                        @endforeach
                        @endif

                    </div>
                    <div class="col-lg-8">
                        <form action="{{URL::to('/update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{$sport->id}}">

                            <div class="mb-3">
                                <label for="">Tên Sport</label>
                                <input type="text" name="name" required class="form-control" value="{{$sport->name}}">
                            </div>
                            <div class="mb-3">
                                <label for="">Mô tả</label>
                                <input type="text" name="describe" required class="form-control" value=" {{$sport->describe}}">
                            </div>
                            <div class="mb-3">
                                <label for="">Loại Sport</label>
                                <select id="category_id" name="category_id" class="form-control">
                                    @foreach($category as $key => $cat)
                                    <option <?php if ($cat->id == $sport->category_id) {
                                                echo ("selected");
                                            } ?> value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Giá theo giờ</label>
                                <select id="product_categorie" name="price_id" class="form-control">
                                    @foreach($prices as $key => $pri)
                                    <option <?php if ($pri->id == $sport->price_id) {
                                                echo ("selected");
                                            } ?> value="{{$pri->id}}">{{$pri->price}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="">Hình ảnh chính</label>
                                <input type="file" name="image"  class="course form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">Hình ảnh mô tả</label>
                                <input type="file" id="input-file-now-custom-3" class="form-control" name="images[]" multiple>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection