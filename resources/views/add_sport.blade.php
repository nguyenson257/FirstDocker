@extends('layout')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    <h4>Thêm mới Sport</h4>
                </div>
                <div class="card-body">

                    <form action="{{URL::to('/save')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="token" value="{{ csrf_token() }}">

                        <div class="mb-3">
                            <label for="">Tên Sport</label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Mô tả</label>
                            <input type="text" name="describe" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Loại Sport</label>
                            <select id="category_id" name="category_id" class="form-control">
                                @foreach($category as $key => $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Giá theo giờ</label>
                            <select id="product_categorie" name="price_id" class="form-control">
                                @foreach($prices as $key => $pri)
                                <option value="{{$pri->id}}">{{$pri->price}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Hình ảnh chính</label>
                            <input type="file" name="image" required class="course form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Hình ảnh mô tả</label>
                            <input type="file" id="input-file-now-custom-3" class="form-control" name="images[]" multiple>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection