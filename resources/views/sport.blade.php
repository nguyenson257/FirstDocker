@extends('layout')
@section('content')
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Sport <b>Details</b></h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="search-box" id="search">
                            <i class="material-icons">&#xE8B6;</i>
                            <form id="search-form" action="{{URL::to('sport/search-advance')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="text" class="form-control " name="name" placeholder="Search&hellip;">
                            </form>
                        </div>
                        <div class="row" id="sports">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="{{URL::to('add-sport')}}">Thêm mới</a>
                    </div>

                </div>
            </div>
            <table id="selectedColumn" class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="th-sm">@sortablelink('name', 'Tên Sport')</th>
                        <th class="th-sm">@sortablelink('category.name', 'Loại Sport')</th>
                        <th class="th-sm">Hình ảnh chính</th>
                        <th class="th-sm">@sortablelink('price.price', 'Giá theo giờ')</th>
                        <th class="th-sm">Mô tả</th>
                        <th class="th-sm">@sortablelink('updated_at', 'Ngày cập nhật')</th>
                        <th class="th-sm">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sports as $key => $spo)
                    <tr class="pd-5">
                        <td class="pd-5">{{$spo->name}}</td>
                        <td class="pd-5">
                            {{$spo->category->name}}
                        </td>
                        <td class="pd-5"><img src="{{URL::to('uploads/'.$spo->image_path)}}" height="100" width="150" /></td>
                        <td class="pd-5 tc">
                            {{$spo->price->price}}
                        </td>
                        <td class="pd-5">{{$spo->describe}}</td>
                        <td class="pd-5">{{$spo->updated_at}}</td>
                        <td class="pd-5">
                            <a href="{{URL::to('/detail/'.$spo->id)}}" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                            <a href="{{URL::to('/edit-sport/'.$spo->id)}}" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a href="{{URL::to('/delete/'.$spo->id)}}" class="delete" title="Delete" data-toggle="tooltip" onclick="return confirm('Bạn có chắc chẵn muốn xóa sản phẩm này không?')"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                {{$sports->links('paginate')}}
            </div>
        </div>
    </div>
</div>

@endsection