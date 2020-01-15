@extends('layout.auth.app')
@section('my_title') Signin @stop
@section('my_content')
    @include('partials.auth.message')
    <div class="container">
        <div class="col-sm-4 offset-sm-4 mt-5">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center text-success">Smart POS</h3>
                    <p class="text-center text-secondary mb-5">Signin to continued your session.</p>
                    <form method="post" action="{{route('login')}}">
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
                            <button type="submit" class="btn btn-outline-primary btn-block">Signin</button>
                        </div>
                        @csrf
                    </form>
                    Don't have an account ? <a href="{{route('register')}}">Sign Up</a>
                </div>
            </div>
        </div>
    </div>

    @stop