@extends('layout.backend.app')

@section('my_title') Add User @stop

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add User</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop

@section('content_body')

    <section class="content pb-5">
        <div class="container-fluid">
        <div class="col-sm-6 mb-5">
            <form method="post" action="{{route('register')}}">
                <div class="form-group">
                    <label for="name">Username</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        </div>
                        <input type="text" name="name" id="name" class="form-control @if($errors->has('name')) is-invalid @endif">
                        @if($errors->has('name')) <div class="invalid-feedback">{{$errors->first('name')}}</div> @endif
                    </div>

                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <input type="email" name="email" id="email" class="form-control @if($errors->has('email')) is-invalid @endif">
                        @if($errors->has('email')) <div class="invalid-feedback">{{$errors->first('email')}}</div> @endif
                    </div>

                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-key"></i>
                            </div>
                        </div>
                        <input type="password" name="password" id="password" class="form-control @if($errors->has('password')) is-invalid @endif">
                        @if($errors->has('password')) <div class="invalid-feedback">{{$errors->first('password')}}</div> @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fas fa-key"></i>
                            </div>
                        </div>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control @if($errors->has('confirm_password')) is-invalid @endif">
                        @if($errors->has('confirm_password')) <div class="invalid-feedback">{{$errors->first('confirm_password')}}</div> @endif
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-primary btn-block">Save Change</button>
                </div>
                @csrf
            </form>
        </div>

    </div>
    </section>

@stop