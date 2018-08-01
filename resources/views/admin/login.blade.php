@extends('layouts.admin.login')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <form action="{{route('login_path')}}" method="post">
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login de usuario</h3>
                    </div>
                    <div class="panel-body">
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
                            <label for="txt_codigo">Username</label>
                            <input type="text" class="form-control" placeholder="Username" id="txt_codigo" name="email" value="">
                        </div>
                        <div class="form-group">
                            <label for="txt_codigo">Password</label>
                            <input type="password" class="form-control" placeholder="Password" id="txt_password" name="password" value="">
                        </div>
                        <div class="form-group hide">
                            <label for="txt_codigo">pa</label>
                            <input type="text" class="form-control" placeholder="Password" value="{{bcrypt('cusco')}}">
                        </div>

                    </div>
                    <div class="panel-footer">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
@stop