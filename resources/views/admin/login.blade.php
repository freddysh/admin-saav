@extends('layouts.admin.login')
@section('content')
    <div class="row justify-content-center align-items-center mt-5">
        <div class="col-lg-4">
            <img alt="Logo goto peru" src="{{asset("img/logos/logo-saav-xoddo.png")}}" class="w-100 px-4 pb-0">
            <p class="text-white text-center">System v0.1</p>
            <form action="{{route('login_path')}}" method="post">
            <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Login de usuario</h3>
                    </div>
                    <div class="card-body">
                        @if($errors->all())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="txt_codigo" class="font-weight-bold text-secondary">Username</label>
                            <input type="text" class="form-control" placeholder="Username" id="txt_codigo" name="email" value="">
                        </div>
                        <div class="form-group">
                            <label for="txt_codigo" class="font-weight-bold text-secondary">Password</label>
                            <input type="password" class="form-control" placeholder="Password" id="txt_password" name="password" value="">
                        </div>
                        <div class="form-group d-none">
                            <label for="txt_codigo">pa</label>
                            <input type="text" class="form-control" placeholder="Password" value="{{bcrypt('cusco')}}">
                        </div>

                    </div>
                    <div class="card-footer">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@stop
