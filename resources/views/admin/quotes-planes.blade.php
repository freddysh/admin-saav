@extends('layouts.admin.admin')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Quotes</li>
            <li class="active">New</li>
        </ol>
    </div>
    <?php
    $cotizacion_;
    ?>
    @foreach($cotizacion as $cotizacion1)
        <?php
        $cotizacion_=$cotizacion1;
        ?>
    @endforeach
    <?php
    $array_destinos1='';
    ?>
    @foreach($destinos as $destino)
        <?php
        $array_destinos1.=$destino.'$';
        ?>
    @endforeach
    <?php
        $array_destinos1= substr($array_destinos1,0,strlen($array_destinos1)-1) ;
    ?>
    <!-- Modal -->
    <div class="modal left fade" id="catalog-right" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-primary" id="myModalLabel2">Catalog</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('crear_paquete_enlatados_path')}}" method="POST">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="itinerary-heading-1">
                                    <h4 class="panel-title">
                                        @php
                                            $nro_destinos=0;
                                            $array_destinos=array();
                                        @endphp
                                        @foreach($p_paquete as $p_paquete_)
                                            @php
                                                $hay_destinos=0;
                                            @endphp
                                            @foreach($p_paquete_->itinerarios as $itinerarios)
                                                @foreach($itinerarios->destinos as $destino)
                                                    @php
                                                        $array_destinos[$destino->destino]=$destino->destino;
                                                    @endphp
                                                @endforeach
                                            @endforeach

                                            @foreach($destinos as $destino1)
                                                @if(in_array($destino1,$array_destinos))
                                                    @php
                                                        $hay_destinos++;
                                                    @endphp
                                                @endif
                                            @endforeach

                                            @if($hay_destinos==count($array_destinos))
                                                @php
                                                    $nro_destinos++;
                                                @endphp
                                            @endif
                                        @endforeach
                                        {{--{{dd($array_destinos)}}--}}
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#itinerary-modal-1" aria-expanded="true" aria-controls="collapseOne">
                                            <b>{{$cotizacion_->duracion}} DAYS</b> <span class="badge pull-right">{{$nro_destinos}}</span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="itinerary-modal-1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="itinerary-heading-1">
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <table class="table table-condensed table-striped margin-bottom-0 font-montserrat">
                                                <tbody>
                                                @foreach($p_paquete as $p_paquete_)
                                                    @php
                                                        $hay_destinos=0;
                                                        $lista='';
                                                    @endphp
                                                    @foreach($p_paquete_->itinerarios as $itinerario)
                                                        @php
                                                            $lista.="<p class=\"text-12 text-primary\"><b>Dia: ".$itinerario->dias."</b> ".$itinerario->titulo."</p>";
                                                        @endphp
                                                    @endforeach
                                                    @foreach($destinos as $destino1)
                                                        {{--@foreach($p_paquete_->itinerarios as $itinerarios)--}}
                                                            @foreach($array_destinos as $destino)
                                                                @if($destino1==$destino)
                                                                    @php
                                                                        $hay_destinos++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        {{--@endforeach--}}
                                                    @endforeach
                                                    @if($hay_destinos==count($destinos))
                                                        <tr>
                                                            <td>
                                                                <label class="checkbox-inline">
                                                                    <input type="checkbox" id="paquetes" name="paquetes[]" value="{{$p_paquete_->id}}">
                                                                    <span id="propover_{{$p_paquete_->id}}" data-toggle="popover" title="Outline" data-content="{{$lista}}"><b>{{$p_paquete_->codigo}}</b> {{$p_paquete_->titulo}}</span>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="btn-right-fixed">
                            {{csrf_field()}}
                            <input type="hidden" name="p_cotizacion_id" value="{{$cotizacion_->id}}">
                            <input type="hidden" name="cliente_id_" value="{{$cliente->id}}">
                            <input type="hidden" name="datos" value="{{$array_destinos1.'_'.$acomodacion_s.'_'.$acomodacion_d.'_'.$acomodacion_t.'_'.$acomodacion_m}}">
                            <input type="hidden" name="txt_day_" value="{{$cotizacion_->duracion}}">
                            <button type="submit" class="btn btn-primary">add <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>

            </div><!-- modal-content -->

        </div><!-- modal-dialog -->
    </div><!-- modal -->
    <form action="{{route('package_cotizacion_send_path')}}" method="post" id="package_new_path_id">
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">1</span> Client</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <b>
                    <span class="text-20 text-primary">Name : </span>
                    <span class="text-15">{{$cliente->nombres}}</span>
                </b>
            </div>
            <div class="col-md-3">
                <b>
                    <span class="text-20 text-primary">Email : </span>
                    <span class="text-15">{{$cliente->email}}</span>
                </b>
            </div>
            <div class="col-md-3">
                <b>
                    <span class="text-20 text-primary">Country : </span>
                    <span class="text-15">{{$cliente->nacionalidad}}</span>
                </b>
            </div>


        </div>
        <div class="row">
            <div class="col-md-4">
                <b>
                    <span class="text-20 text-primary">Phone : </span>
                    <span class="text-15">{{$cliente->telefono}}</span>
                </b>
            </div>
            <div class="col-md-3">
                <div class="text-20">
                    <b>

                        <span class="text-primary">Travellers:</span>
                    {{--{{dd($cotizacion_)}}--}}
                            @for($i=0;$i<$cotizacion_->nropersonas;$i++)
                        <i class="fa fa-male" aria-hidden="true"></i>
                    @endfor

                    </b>
                </div>
            </div>
            <div class="col-md-2">
                <b>
                    <span class="text-20 text-primary">Days : </span>
                    <span class="text-20">{{$cotizacion_->duracion}}</span>
                </b>
            </div>
            <div class="col-md-3">
                <b>
                    <span class="text-20 text-primary">Travel date : </span>
                    <span class="text-20">{{$cotizacion_->fecha}}</span>
                </b>
            </div>
            <div class="col-md-4">
                <b>
                    <span class="text-20 text-primary">for : </span>
                    @if($cotizacion_->star_2=='2')
                        2 <span class="text-orange-goto text-20"><i class="fa fa-star-half-o" aria-hidden="true"></i></span> /
                    @endif
                    @if($cotizacion_->star_3=='3')
                        3 <span class="text-orange-goto text-20"><i class="fa fa-star-half-o" aria-hidden="true"></i></span></i>/
                    @endif
                    @if($cotizacion_->star_4=='4')
                        4 <span class="text-orange-goto text-20"><i class="fa fa-star-half-o" aria-hidden="true"></i></span></i>/
                    @endif
                    @if($cotizacion_->star_5=='5')
                        5 <span class="text-orange-goto text-20"><i class="fa fa-star-half-o" aria-hidden="true"></i></span></i>
                    @endif
                </b>
            </div>

            <div class="col-md-8">
                <b>
                    <?php
                        $array_destinos='';
                    ?>
                    <span class="text-20 text-primary">on Detination : </span>
                    @foreach($destinos as $destino)
                        <?php
                            $array_destinos.=$destino.'$';
                        ?>
                        <span class="text-orange-goto text-15">{{$destino}}</span> -
                    @endforeach
                    <?php
                        $array_destinos= substr($array_destinos,0,strlen($array_destinos)-1) ;
                    ?>
                </b>
            </div>
            <div class="col-md-12">
                <b>
                    <span class="text-20 text-primary">and Acomodacion : </span>
                    @if($acomodacion_s=='1')
                        <i class="fa fa-bed fa-2x" aria-hidden="true"></i> -
                    @endif
                    @if($acomodacion_d=='2')
                        <i class="fa fa-male fa-2x" aria-hidden="true"></i><i class="fa fa-male fa-2x" aria-hidden="true"></i> -
                    @endif
                    @if($acomodacion_m=='2')
                        <i class="fa fa-venus-mars fa-2x" aria-hidden="true"></i> -
                    @endif
                    @if($acomodacion_t=='3')
                        <i class="fa fa-bed fa-2x" aria-hidden="true"></i><i class="fa fa-bed fa-2x" aria-hidden="true"></i><i class="fa fa-bed fa-2x" aria-hidden="true"></i>
                    @endif
                </b>
            </div>
        </div>
        <div class="row margin-top-20">
        </div>
        <div class="row bg-info">
            <div class="col-md-4  text-center">
                <a href="{{route('new_plan_path',[$cotizacion_->id,$array_destinos,$acomodacion_s.'_'.$acomodacion_d.'_'.$acomodacion_t.'_'.$acomodacion_m])}}" class="btn btn-lg btn-primary">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> New
                </a>
            </div>
            <div class="col-md-4 margin-top-10 text-center">
                <b class="text-warning">OR</b>
            </div>
            <div class="col-md-4 text-center">
                <button type="button" class="btn btn-lg btn-primary pull-center" data-toggle="modal" data-target="#catalog-right">
                    <i class="fa fa-list-ul" aria-hidden="true"></i> From Catalog
                </button>
            </div>
        </div>



        <div id="list-package"  class="row ">
            <div class="col-md-3 margin-top-10 hide">
                <div class="portada-pdf">
                    <img src="{{asset('img/portada/new-proposal.jpg')}}" alt="" class="img-responsive">
                    <div class="box-dowload1 text-green-goto">
                        <b class="margin-top-5 text-green-goto"><i class="fa fa-newspaper-o text-green-goto" aria-hidden="true"></i> New Package</b>
                        <a href="{{route('new_plan_path',[$cotizacion_->id,$array_destinos,$acomodacion_s.'_'.$acomodacion_d.'_'.$acomodacion_t.'_'.$acomodacion_m])}}" class="pull-right btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </div>
                    <div class="box-letter-proposal text-center">
                        <span class="text-orange-goto">NEW</span>
                    </div>
                </div>
            </div>
            {{--<p>cotizacion_id:{{$cotizacion_->id}}</p>--}}
            <?php
            $planes[]='A';
            $planes[]='B';
            $planes[]='C';
            $planes[]='D';
            $planes[]='E';
            $planes[]='F';
            $planes[]='G';
            $planes[]='H';
            $planes[]='I';
            $planes[]='K';
            $planes[]='L';
            $planes[]='M';
            $planes[]='N';
            $planes[]='O';
            $planes[]='P';
            $planes[]='Q';
            $planes[]='R';
            $planes[]='S';

            $pos_plan=0;
            ?>
            {{--{{dd($cotizacion_)}}--}}
            @foreach($cotizacion_->paquete_cotizaciones as $paquete)
                <div class="col-md-3 margin-top-10">
                    <div class="portada-pdf">
                        <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                        <div class="box-dowload">
                            <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> proposal</b>
                            {{csrf_field()}}
                            <a href="{{route('quotes_pdf_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                            <a href="{{route('mostar_newpackage_path',$paquete->id)}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>

                            {{--<button type="button" id="plan_{{$pos_plan}}"  class="planes pull-right btn btn-danger btn-sm" onclick="activarPlan('{{$paquete->id}}','{{$cotizacion_->nombre}}','{{$cotizacion_->id}}','{{$pos_plan}}')">--}}
                            {{--<i class="fa fa-toggle-off" aria-hidden="true"></i>--}}
                            {{--</button>--}}
                        </div>
                        <div class="box-letter-proposal text-center">
                            <span class="text-orange-goto">{{$planes[$pos_plan]}}</span>
                        </div>
                    </div>
                </div>

                {{--<div class="col-md-3 margin-top-10">--}}
                    {{--<div class="portada-pdf">--}}
                        {{--<img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">--}}
                        {{--<div class="box-dowload">--}}
                            {{--<b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> proposal</b>--}}
                            {{--<a href="#" class="pull-right btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>--}}
                            {{--<a href="#" class="pull-right btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>--}}
                        {{--</div>--}}
                        {{--<div class="box-letter-proposal text-center">--}}
                            {{--<span class="text-orange-goto">{{$planes[$pos_plan]}}</span>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <?php
                $pos_plan++;
                ?>
            @endforeach
            <div class="col-md-3 hide">
                <div class="portada-pdf">
                    <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                    <div class="box-dowload">
                        <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> GTP900-B.jpg</b>
                        <a href="{{asset('pdf/proposals_1.pdf')}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>
                    <div class="box-letter-proposal text-center">
                        B
                    </div>
                </div>
            </div>
            <div class="col-md-3 hide">
                <div class="portada-pdf">
                    <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                    <div class="box-dowload">
                        <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> GTP900-C.jpg</b>
                        <a href="{{asset('pdf/proposals_1.pdf')}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                    </div>
                    <div class="box-letter-proposal text-center">
                        C
                    </div>
                </div>
            </div>

        </div>
        <div class="row margin-top-40">
            <div class="col-md-12 text-right">
                {{csrf_field()}}
                <input type="hidden" name="cotizacion_id" id="cotizacion_id" value="{{$cotizacion_->id}}">
                <input type="hidden" name="cliente_id" id="cliente_id" value="{{$cliente->id}}">
                @foreach($destinos as $destino)
                    <input type="hidden" name="destinos[]" id="destinos" value="{{$destino}}">
                @endforeach
                <button type="submit" class="btn btn-lg btn-success">Send Quote <i class="fa fa-send" aria-hidden="true"></i></button>
                </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            calcular_resumen();
            @foreach($p_paquete as $p_paquete_)

                $('#propover_{{$p_paquete_->id}}').popover({html: true, placement: "bottom", trigger: "hover"});
            {{--$('#propover_{{$p_paquete_->id}}').popover({title: "Outline", content: "{{$lista}}",html: true, placement: "bottom", trigger: "hover"});--}}
            @endforeach
        } );
    </script>
@stop