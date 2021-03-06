@extends('layout.backend.app')

@section('my_title') Categories @stop

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop

@section('content_body')

    <section class="content pb-5">
        <div class="container-fluid">
              <div class="row">
                  <div class="col-sm-4">
                      <form method="post" action="{{route('category.new')}}">
                          <div class="form-group">
                              <label for="category_name">Category Name</label>
                              <input type="text" name="category_name" id="category_name" class="form-control @if($errors->has('category_name')) is-invalid @endif">
                              @if($errors->has('category_name')) <div class="invalid-feedback">{{$errors->first('category_name')}}</div> @endif
                          </div>
                          <div class="form-group">
                              <button type="submit" class="btn btn-outline-primary">Save</button>
                          </div>
                          @csrf
                      </form>
                  </div>
                  <div class="col-sm-8">
                        <div class="card shadow ">
                            <div class="card-header">All Categories</div>
                            <div class="card-body">
                                <table class="table table-borderless table-hover">
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    @foreach($cats as $c)
                                        <tr>
                                            <td>{{$c->category_name}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-cogs"></i>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a data-toggle="modal" data-target="#e{{$c->id}}" class="dropdown-item text-info" href="#"><i class="fas fa-edit"></i> Edit</a>
                                                        <a data-toggle="modal" data-target="#d{{$c->id}}" class="dropdown-item text-danger" href="#"><i class="fas fa-times-circle"></i> Drop</a>
                                                    </div>
                                                </div>

                                                {{-- Start Edit modal--}}
                                                <div id="e{{$c->id}}" class="modal fade" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <form method="post" action="{{route('category.update')}}">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{$c->id}}">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Edit Category</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="category_name">Category Name</label>
                                                                        <input type="text" name="category_name" id="catgory_name" class="form-control" value="{{$c->category_name}}">

                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-outline-primary">Save Change</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End Edit modal--}}

                                                {{-- Start delete modal--}}
                                                <div id="d{{$c->id}}" class="modal fade" tabindex="-1" role="dialog">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirm</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center text-danger">
                                                                <i class="fas fa-exclamation-triangle fa-3x"></i>
                                                                <p>The selected category will remove from your database.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{route('category.remove',['id'=>$c->id])}}">Agree</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End delete modal--}}
                                            </td>
                                        </tr>
                                        @endforeach
                                </table>
                                {{$cats->links()}}
                            </div>
                        </div>
                  </div>
              </div>
        </div>
    </section>

@stop