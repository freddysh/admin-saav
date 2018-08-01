@extends('layouts.admin.admin')
@section('content')
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>Quotes</li>
            <li class="active">New</li>
        </ol>
    </div>
    <form action="{{route('package_cotizacion_save_path')}}" method="post" id="package_new_path_id">
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-primary"><span class="label bg-primary">1</span> Client</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="txt_name">Name</label>
                    <input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="Name" >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="txt_email">Email</label>
                    <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="Email">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="txt_country">Country</label>
                    <input type="text" class="form-control" id="txt_country" name="txt_country" placeholder="Country">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="txt_phone">Phone</label>
                    <input type="text" class="form-control" id="txt_phone" name="txt_phone" placeholder="Phone">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-primary"><span class="label bg-primary">2</span> Details</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="txt_travellers">Travellers</label>
                    <input type="number" class="form-control" id="txt_travellers" name="txt_travellers" placeholder="Travellers" min="1">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="txt_days">Days</label>
                    <input type="number" class="form-control" id="txt_days" name="txt_days" placeholder="Days" min="1">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="txt_travel_date">Travel date</label>
                    <input type="date" class="form-control" id="txt_travel_date" name="txt_travel_date" placeholder="Travel date">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-primary"><span class="label bg-primary">3</span> Categories</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-orange-goto">
                        <input class="destinospack" type="checkbox" name="strellas_2" id="strellas_2" value="2" onchange="filtrar_estrellas()">
                        2 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-orange-goto">
                        <input class="destinospack" type="checkbox" name="strellas_3" id="strellas_3" value="3" onchange="filtrar_estrellas()">
                        3 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-orange-goto">
                        <input class="destinospack" type="checkbox" name="strellas_4" id="strellas_4" value="4" onchange="filtrar_estrellas()">
                        4 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox1">
                    <label class=" text-orange-goto">
                        <input class="destinospack" type="checkbox" name="strellas_5" id="strellas_5" value="5" onchange="filtrar_estrellas()">
                        5 <i class="fa fa-star-half-o fa-3x" aria-hidden="true"></i>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4 class="font-montserrat text-primary"><span class="label bg-primary">4</span> Acomodacion</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="checkbox1">
                    <label class=" text-unset">
                        <input class="destinospack" type="checkbox" name="acomodacion_s" id="acomodacion_s" value="1">
                        <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox1">
                    <label class=" text-unset">
                        <input class="destinospack" type="checkbox" name="acomodacion_d" id="acomodacion_d" value="2">
                        <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox1">
                    <label class=" text-unset">
                        <input class="destinospack" type="checkbox" name="acomodacion_m" id="acomodacion_m" value="2">
                        <b class="text-20px"><i class="fa fa-venus-mars fa-2x" aria-hidden="true"></i></b>
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="checkbox1">
                    <label class=" text-unset">
                        <input class="destinospack" type="checkbox" name="acomodacion_t" id="acomodacion_t" value="3">
                        <b class="text-20px"><i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i> <i class="fa fa-bed fa-2x" aria-hidden="true"></i></b>

                    </label>
                </div>
            </div>

        </div>
        <div id="list-package"  class="row hide">
            <div class="col-md-3">
                <div class="portada-pdf">
                    <img src="{{asset('img/portada/new-proposal.jpg')}}" alt="" class="img-responsive">
                    <div class="box-dowload">
                        <b class="margin-top-5"><i class="fa fa-newspaper-o text-green-goto" aria-hidden="true"></i> New Package</b>
                        <a href="{{asset('pdf/proposals_1.pdf')}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </div>
                    <div class="box-letter-proposal text-center">
                        NEW
                    </div>
                </div>
            </div>
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
        <div class="row margin-top-20">
            <div class="col-md-12">
                <h4 class="font-montserrat text-primary"><span class="label bg-primary">5</span> Destinations</h4>
                <div class="divider margin-bottom-20"></div>
            </div>
        </div>
        <div class="row">
            {{csrf_field()}}
            @foreach($destinos as $destino)
                <div class="col-md-3">
                    <div class="checkbox1">
                        <label class=" text-unset">
                            <input class="destinospack" type="checkbox" name="destinos[]" value="{{$destino->destino}}">
                            {{$destino->destino}}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row margin-top-20">
            <div class="col-md-12 text-center">
                {{csrf_field()}}
                <button type="submit" class="btn btn-lg btn-primary">Create package <i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            calcular_resumen();
        } );
    </script>
@stop