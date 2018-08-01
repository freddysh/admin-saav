@extends('layouts.admin.admin')
@section('content')

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">Catalog</li>
        </ol>
    </div>

    <div class="row">
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

@stop