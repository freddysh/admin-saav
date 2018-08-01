@extends('layouts.admin.admin')
@section('content')

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">New</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">1</span></h4>
            <div class="divider margin-bottom-20"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="txt_name">Name</label>
                <input type="text" class="form-control" id="txt_name" name="txt_name" placeholder="Name" value="Hidalgo">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="txt_email">Email</label>
                <input type="text" class="form-control" id="txt_email" name="txt_email" placeholder="Email" value="hidalgo@gmail.com">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="txt_country">Country</label>
                <input type="number" class="form-control" id="txt_country" name="txt_country" placeholder="Country" value="Peru">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="txt_phone">Phone</label>
                <input type="text" class="form-control" id="txt_phone" name="txt_phone" placeholder="Phone" value="980385734">
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">2</span></h4>
            <div class="divider margin-bottom-20"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="txt_travellers">Travellers</label>
                <input type="text" class="form-control" id="txt_travellers" name="txt_travellers" placeholder="Travellers" value="2">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="txt_days">Days</label>
                <input type="number" class="form-control" id="txt_days" name="txt_days" placeholder="Days" value="5">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="txt_travel_date">Travel date</label>
                <input type="date" class="form-control" id="txt_travel_date" name="txt_travel_date" placeholder="Travel date" value="04/04/2017">
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">3</span></h4>
            <div class="divider margin-bottom-20"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <b>Hotel Tours</b>
        </div>
        <div class="col-md-10">
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox2" value="option2" checked> 2 Stars
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox2" value="option2"> 3 Stars
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox2" value="option2" checked> 4 Stars
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox2" value="option2"> 5 Stars
            </label>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="font-montserrat text-orange-goto"><span class="label bg-orange-goto">4</span></h4>
            <div class="divider margin-bottom-20"></div>
        </div>
    </div>

    <div class="row">
        {{--<div class="col-md-4" style="position: relative">--}}
            {{--<iframe src="https://docs.google.com/viewerng/viewer?url=http://travel.gotoperu.travel/pdf/proposals_1.pdf&embedded=true" width="100%" height="420px" frameborder="0" style="margin: 0px;"></iframe>--}}
        {{--</div>--}}
        <div class="col-md-3">
            <div class="portada-pdf">
                <img src="{{asset('img/portada/proposal-martin-pdf.jpg')}}" alt="" class="img-responsive">
                <div class="box-dowload">
                    <b class="margin-top-5"><i class="fa fa-file-pdf-o text-danger" aria-hidden="true"></i> GTP900-A.jpg</b>
                    <a href="{{asset('pdf/proposals_1.pdf')}}" class="pull-right btn btn-default btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                </div>
                <div class="box-letter-proposal text-center">
                    A
                </div>
            </div>
        </div>
        <div class="col-md-3">
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
        <div class="col-md-3">
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
        <div class="col-md-12 text-center">
            <button type="button" class="btn btn-lg btn-default pull-left" data-toggle="modal" data-target="#catalog-right">
                From Catalog
            </button>
            <a href="{{route('qoute_options_path', 1)}}" class="btn btn-lg btn-danger pull-right">Detailed <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
        </div>
    </div>

    <div class="collapse" id="catalog">
        <div class="margin-top-10">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="itinerary-heading-1">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#itinerary-1" aria-expanded="true" aria-controls="collapseOne">
                                        <b>1 days</b> <span class="badge pull-right">14</span>
                                    </a>
                                </h4>
                            </div>
                            <div id="itinerary-1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="itinerary-heading-1">
                                <div class="panel-body">
                                    <div class="col-md-9 col-md-offset-1">
                                        <table class="table table-condensed table-striped margin-bottom-0 font-montserrat">
                                            {{--<caption>table title and/or explanatory text</caption>--}}
                                            <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Title</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>GTP500</td>
                                                <td>Machu picchu & titicaca</td>
                                                <td class="text-center">
                                                    <a href="" class="btn btn-link">view</a>
                                                    <a href="" class="btn btn-link"><span class="text-danger">Generate PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>GTP500</td>
                                                <td>Machu picchu & titicaca</td>
                                                <td class="text-center">
                                                    <a href="" class="btn btn-link">view</a>
                                                    <a href="" class="btn btn-link"><span class="text-danger">Generate PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i></span></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="">

        <!-- Modal -->
        <div class="modal left fade" id="catalog-right" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel2">Catalog</h4>
                    </div>

                    <div class="modal-body">

                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="itinerary-heading-1">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#itinerary-modal-1" aria-expanded="true" aria-controls="collapseOne">
                                            <b>1 days</b> <span class="badge pull-right">14</span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="itinerary-modal-1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="itinerary-heading-1">
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <table class="table table-condensed table-striped margin-bottom-0 font-montserrat">

                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox1" value="option1" checked> <b>GTP500</b> Machu picchu & titicaca
                                                        </label>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" id="inlineCheckbox1" value="option1"> <b>GTP500</b> Machu picchu & titicaca
                                                        </label>
                                                    </td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="btn-right-fixed">
                            <a href="" class="btn btn-primary">add <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>

                </div><!-- modal-content -->

            </div><!-- modal-dialog -->
        </div><!-- modal -->


    </div><!-- container -->

@stop