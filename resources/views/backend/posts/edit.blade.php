@extends('layout.backend.app')

@section('my_title') Edit Post @stop

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Post</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Post</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop

@section('content_body')

    <section class="content pb-5">
        <div class="container-fluid">
            <div class="row px-5">
                <div>
                    <div class="row">
                        <div class="col-12 card p-2">
                            <div class="row">
                                @foreach($post->postimage as $img)
                                    <div class="col-sm-2">
                                        <a href="{{route('delete.post.image',['id'=>$img->id])}}" class="text-danger float-right"><i class="fas fa-times-circle"></i></a>
                                        <img src="{{route('post.image',['img_name'=>$img->image])}}" class="img-thumbnail">
                                    </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                    <form enctype="multipart/form-data" method="post" action="{{route('post.update')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$post->id}}">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="image">Image</label>
                                <input  type="file" multiple name="image[]" id="image" class="form-control-file @if($errors->has('image')) is-invalid @endif">
                                @if($errors->has('image')) <span class="invalid-feedback">{{$errors->first('image')}}</span> @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="item_name">Item Name</label>
                                <input value="{{$post->item_name}}" type="text" name="item_name" id="item_name" class="form-control">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="price">Price</label>
                                <input value="{{$post->price}}" type="number" name="price" id="price" class="form-control">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="category">Categories</label>
                                <select name="category" id="category" class="custom-select">
                                    @foreach($cats as $c)
                                        <option {{$post->category_id==$c->id ? "selected" : '' }} value="{{$c->id}}">{{$c->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control">{{$post->dsc}}</textarea>
                                @if($errors->has('description')) <span class="text-danger">{{$errors->first('description')}}</span> @endif
                            </div>

                            <div class="form-group col-sm-12">
                                <a href="{{route('posts')}}" class="btn btn-outline-secondary">Cancel</a>
                                <button type="submit" class="btn btn-outline-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop