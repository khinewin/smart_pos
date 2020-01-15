@extends('layout.auth.app')

@section('my_title') Welcome @stop

@section('my_content')

    @include('partials.frontend.navbar')

    <div class="container-fluid pt-2 pb-5">


        <div class="row">
            <div class="col-sm-3">
                <div class="card shadow-sm mb-4">

                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <form method="get" action="{{route('search.post')}}">
                            <div class="form-group">
                                <input type="search" name="q" class="form-control" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow-sm">
                    <div class="card-header">Categories</div>
                    <div class="card-body">
                        <table class="table table-hover table-borderless">
                            @foreach($cats as $c)
                                <tr>
                                    <td><a href="{{route('post.category',['id'=>$c->id])}}" class="d-block">{{$c->category_name}}</a></td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <h5>
                    Available items.
                </h5>
                <div class="row">
                    <div class="col-12">
                        @foreach($posts as $p)
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="row">

                                                    <div class="col-12">
                                                        <img src="{{route('post.image.front',['img_name'=>$p->first_postimage->first()->image])}}" class="img-thumbnail">
                                                        {!!   DNS1D::getBarcodeHTML($p->id, "CODABAR") !!}
                                                    </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div>
                                                <div>
                                                   <div class="row">
                                                       <div class="col-6 py-3 shadow-sm">
                                                           <div class="text-secondary small">Item Name</div>
                                                           <div>{{$p->item_name}}</div>
                                                       </div>
                                                       <div class="col-6 py-3 shadow-sm">
                                                           <div class="text-secondary small">Price</div>
                                                           <div>{{$p->price}} MMK</div>
                                                       </div>
                                                       <div class="col-6 py-3 shadow-sm">
                                                           <div class="text-secondary small">Description</div>
                                                           <div>{{$p->dsc}}</div>
                                                       </div>
                                                       <div class="col-6 py-3 shadow-sm">
                                                           <div class="text-secondary small">Category</div>
                                                           <div>{{$p->category->category_name}}</div>
                                                       </div>
                                                       <div class="col-6 py-3 shadow-sm">
                                                           <div class="text-secondary small">User</div>
                                                           <div>{{$p->user->name}}</div>
                                                       </div>
                                                       <div class="col-6 py-3 shadow-sm">
                                                           <div class="text-secondary small">Date</div>
                                                           <div>{{date("D(d) m/Y h:i A", strtotime($p->created_at))}}</div>
                                                       </div>
                                                       <div class="col-6 py-3 shadow-sm">
                                                           <a data-toggle="modal" data-target="#d{{$p->id}}" href="#" class="btn btn-outline-success"><i class="fas fa-eye"></i> Details</a>
                                                       </div>
                                                       <div class="col-6 py-3 shadow-sm">
                                                           <a href="{{route('add.to.cart',['id'=>$p->id])}}" class="btn btn-outline-primary"><i class="fas fa-shopping-cart"></i> Add To Cart</a>
                                                       </div>
                                                   </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Detail Modal Start--}}
                            <div id="d{{$p->id}}" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">

                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-12 row">
                                                    @foreach($p->postimage as $img)
                                                        <div class="col-sm-3">
                                                            <img class="img-thumbnail" src="{{route('post.image.front',['img_name'=>$img->image])}}">
                                                        </div>
                                                        @endforeach
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-6 py-3 shadow-sm">
                                                            <div class="text-secondary small">Item Name</div>
                                                            <div>{{$p->item_name}}</div>
                                                        </div>
                                                        <div class="col-6 py-3 shadow-sm">
                                                            <div class="text-secondary small">Price</div>
                                                            <div>{{$p->price}} MMK</div>
                                                        </div>
                                                        <div class="col-6 py-3 shadow-sm">
                                                            <div class="text-secondary small">Description</div>
                                                            <div>{{$p->dsc}}</div>
                                                        </div>
                                                        <div class="col-6 py-3 shadow-sm">
                                                            <div class="text-secondary small">Category</div>
                                                            <div>{{$p->category->category_name}}</div>
                                                        </div>
                                                        <div class="col-6 py-3 shadow-sm">
                                                            <div class="text-secondary small">User</div>
                                                            <div>{{$p->user->name}}</div>
                                                        </div>
                                                        <div class="col-6 py-3 shadow-sm">
                                                            <div class="text-secondary small">Date</div>
                                                            <div>{{date("D(d) m/Y h:i A", strtotime($p->created_at))}}</div>
                                                        </div>
                                                        <div class="col-6 py-3 shadow-sm">
                                                            <a  href="#" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</a>
                                                        </div>
                                                        <div class="col-6 py-3 shadow-sm">
                                                            <a href="{{route('add.to.cart',['id'=>$p->id])}}" class="btn btn-outline-primary"><i class="fas fa-shopping-cart"></i> Add To Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- Detail Modal End--}}

                            @endforeach
                    </div>
                    {{$posts->links()}}
                </div>
            </div>
        </div>

    </div>



    @stop

