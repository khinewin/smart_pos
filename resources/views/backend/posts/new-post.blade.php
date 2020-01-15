@extends('layout.backend.app')

@section('my_title') New Post @stop

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">New Post</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">New Post</li>
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
                   <form enctype="multipart/form-data" method="post" action="{{route('post.new')}}">
                       @csrf
                       <div class="row">
                       <div class="form-group col-sm-6">
                           <label for="image">Image</label>
                           <input  type="file" multiple name="image[]" id="image" class="form-control-file @if($errors->has('image')) is-invalid @endif">
                           @if($errors->has('image')) <span class="invalid-feedback">{{$errors->first('image')}}</span> @endif
                       </div>
                       <div class="form-group col-sm-6">
                           <label for="item_name">Item Name</label>
                           <input value="{{old('item_name')}}" type="text" name="item_name" id="item_name" class="form-control">
                       </div>
                       <div class="form-group col-sm-6">
                           <label for="price">Price</label>
                           <input type="number" name="price" id="price" class="form-control">
                       </div>
                       <div class="form-group col-sm-6">
                           <label for="category">Categories</label>
                            <select name="category" id="category" class="custom-select">
                                   @foreach($cats as $c)
                                       <option value="{{$c->id}}">{{$c->category_name}}</option>
                                   @endforeach
                            </select>
                        </div>
                       <div class="form-group col-sm-6">
                           <label for="description">Description</label>
                           <textarea name="description" id="description" class="form-control"></textarea>
                           @if($errors->has('description')) <span class="text-danger">{{$errors->first('description')}}</span> @endif
                       </div>

                       <div class="form-group col-sm-12">
                           <button type="submit" class="btn btn-outline-primary">Save</button>
                       </div>
                       </div>
                   </form>
               </div>
            </div>
        </div>
    </section>

@stop