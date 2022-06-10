@extends('layout')
@section('content')

<div class="container">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-f-{{$sport->id}}"><img src="{{URL::to('uploads/'.$sport->image_path)}}" /></div>
                        @foreach($images as $key => $img)
                        <div class="tab-pane" id="pic-{{$img->id}}"><img src="{{URL::to('uploads/'.$img->image_path)}}" /></div>
                        @endforeach
                    </div>
                    <ul class="preview-thumbnail nav nav-tabs">
                        <li class="active"><a data-target="#pic-f-{{$sport->id}}" data-toggle="tab"><img src="{{URL::to('uploads/'.$sport->image_path)}}" /></a></li>
                        @foreach($images as $key => $img)
                        <li><a data-target="#pic-{{$img->id}}" data-toggle="tab"><img src="{{URL::to('uploads/'.$img->image_path)}}" /></a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">{{$sport->name}}</h3>
                    <p class="product-description">{{$sport->describe}}</p>
                    <h4 class="price">Price: <span> {{$sport->price->price}} VND</span></h4>
                    <h5 class="sizes">Category: <span class="size" data-toggle="tooltip" title="small">{{$sport->category->name}}</span>
                    </h5>
                    <div class="action">
                        <button class="add-to-cart btn btn-default" type="button">add to cart</button>
                        <button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection