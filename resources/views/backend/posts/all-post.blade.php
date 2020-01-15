@extends('layout.backend.app')

@section('my_title') Posts @stop

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Posts</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Posts</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop

@section('content_body')

    <section class="content pb-5">
        <div class="container-fluid">
            <div class="row px-1">
                <table class="table table-borderless table-hover">
                    @foreach($posts as $p)
                        <tr class="shadow py-5">
                            <td></td>
                            <td>
                                <div class="text-secondary text-sm">
                                    Item Name
                                </div>
                                <div>
                                    {{$p->item_name}}
                                </div>
                            </td>
                            <td>
                                <div class="text-sm text-secondary">
                                    Price
                                </div>
                                <div>
                                    {{$p->price}}
                                </div>
                            </td>
                            <td>
                                <div class="text-sm text-secondary">
                                    Description
                                </div>
                                <div>
                                    {{$p->dsc}}
                                </div>
                            </td>
                            <td>
                                <div class="text-sm text-secondary">
                                    Categories
                                </div>
                                <div>
                                    {{$p->category->category_name}}
                                </div>
                            </td>
                            <td>
                                <div class="text-sm text-secondary">
                                    Post By
                                </div>
                                <div>
                                    {{$p->user->name}}
                                </div>
                            </td>
                            <td>
                                <div class="text-sm text-secondary">
                                    Actions
                                </div>
                                <div>
                                    <a data-toggle="modal" data-target="#v{{$p->id}}" href="#" class="btn btn-sm btn-outline-success"><i class="fas fa-eye"></i></a>
                                    <a href="{{route('edit.post',['id'=>$p->id])}}" class="btn btn-sm btn-outline-info"><i class="fas fa-edit"></i></a>
                                    <a data-toggle="modal" data-target="#d{{$p->id}}" href="#" class="btn btn-sm btn-outline-danger"><i class="fas fa-times-circle"></i></a>
                                </div>
                                {{--Start Drop Modal--}}
                                <div id="d{{$p->id}}" class="modal fade" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirm</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-danger text-center">
                                                <p>The selected post ID "<strong>{{$p->id}}</strong>" will drop from database parmenently.</p>
                                            </div>
                                            <div class="modal-footer">
                                               <a href="{{route('post.delete',['id'=>$p->id])}}">Agree</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--End Drop Modal--}}
                                {{--Start Detail Modal--}}
                                <div id="v{{$p->id}}" class="modal fade" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">

                                            <div class="modal-body">
                                                <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        @foreach($p->postimage as $img)

                                                                <img src="{{route('post.image',['img_name'=>$img->image])}}" class="img-thumbnail">

                                                            @endforeach
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p>
                                                            <div class="text-secondary text-sm">
                                                                Item Name
                                                            </div>
                                                            <div>
                                                                {{$p->item_name}}
                                                            </div>
                                                        </p>
                                                        <p>
                                                            <div class="text-sm text-secondary">
                                                                Price
                                                            </div>
                                                            <div>
                                                                {{$p->price}}
                                                            </div>
                                                        </p>
                                                        <p>
                                                            <div class="text-sm text-secondary">
                                                                Description
                                                            </div>
                                                            <div>
                                                                {{$p->dsc}}
                                                            </div>
                                                        </p>
                                                        <p>
                                                            <div class="text-sm text-secondary">
                                                                Categories
                                                            </div>
                                                            <div>
                                                                {{$p->category->category_name}}
                                                            </div>
                                                        </p>
                                                        <p>
                                                            <div class="text-sm text-secondary">
                                                                Post By
                                                            </div>
                                                            <div>
                                                                {{$p->user->name}}
                                                            </div>
                                                        </p>
                                                        <p>
                                                            <div class="text-sm text-secondary">
                                                                Date
                                                            </div>
                                                            <div>
                                                                {{date("D(d) m/Y h:i A",strtotime($p->created_at))}}
                                                            </div>
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                {{--End Detail Modal--}}
                            </td>
                        </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </section>

@stop