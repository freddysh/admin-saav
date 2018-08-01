@extends('layouts.admin.contabilidad')
@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <div class="row margin-top-40">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Contabilidad</li>
            <li>Hoteles</li>
            <li class="active">Listar por fechas</li>
        </ol>
    </div>
    {{--<div class="row">--}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">

                            <form action="{{route('list_fechas_rango_hotel_path')}}" method="post" class="form-inline">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="f_ini">From</label>
                                    <input type="date" class="form-control" placeholder="from" name="txt_ini" id="f_ini" required>
                                </div>
                                <div class="form-group">
                                    <label for="f_fin">To</label>
                                    <input type="date" class="form-control" placeholder="to" name="txt_fin" id="f_fin" required>
                                </div>
                                <button type="submit" class="btn btn-default">Filter</button>
                            </form>
                        </div>
                    </div><!-- /.row -->
                    {{--<hr>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Consultas Guardadas</h2>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4 text-center">
                            @if(Session::has('message'))
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {{Session::get('message')}}
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="row">
                        @foreach($consulta as $consultas)
                            <div class="col-md-2 text-center">
                                <form action="{{route('list_fechas_hotel_show_path')}}" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="txt_codigos" value="{{$consultas->id}}">
                                    <a href="javascript:;" onclick="parentNode.submit();">
                                        <img src="{{asset('images/database.png')}}" alt="" class="img-responsive">
                                        {{--{{strftime("%B, %d", strtotime(str_replace('-','/', $disponibilidad->fecha_disponibilidad)))}} <span class="blue-text">${{$disponibilidad->precio_d}}</span>--}}
                                        <span class="font-weight-bold text-18">{{strftime("%A %d de %B de %Y - %H:%M:%S", strtotime(str_replace('-','/', $consultas->updated_at)))}}</span>
                                    </a>
                                    <a href="#" class="display-block text-danger" data-toggle="modal" data-target="#eliminar_{{$consultas->id}}"><i class="fa fa-trash fa-2x"></i></a>
                                </form>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="eliminar_{{$consultas->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        {{--<div class="modal-header">--}}
                                        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                        {{--<h4 class="modal-title" id="myModalLabel">Modal title</h4>--}}
                                        {{--</div>--}}
                                        <form action="{{route('consulta_delete_path', $consultas->id)}}" method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="delete">
                                            <div class="modal-body">
                                                <p class="text-grey-goto text-18"><b><i class="fa fa-exclamation-triangle fa-pull-left fa-2x text-danger" aria-hidden="true"></i> La consulta se eliminara permanentemente.</b></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Confirmar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
    </div>
@stop