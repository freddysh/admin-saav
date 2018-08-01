@extends('layouts.admin.admin')
@section('content')

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li><a href="{{route('qoute_proposal_path', 1)}}">Home</a></li>
            <li class="active">options</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="owl-carousel owl-theme font-montserrat">
                <div class="item box-option">
                    <a href="" class="">
                        <div class="box-option-header text-center">
                            <h4 class="text-orange-goto"><b>GTP309: Puno & Lake Titicaca</b></h4>
                        </div>
                        <div class="box-option-footer bg-grey-goto padding-5 text-center">
                            <h5 class="text-white">Plan A: Personalizacion 1</h5>
                        </div>
                    </a>
                </div>
                <div class="item box-option">
                    <a href="" class="">
                        <div class="box-option-header text-center">
                            <h4 class="text-orange-goto"><b>GTP309: Puno & Lake Titicaca</b></h4>
                        </div>
                        <div class="box-option-footer bg-grey-goto padding-5 text-center">
                            <h5 class="text-white">Plan A: Personalizacion 1</h5>
                        </div>
                    </a>
                </div>
                <div class="item box-option">
                    <a href="" class="">
                        <div class="box-option-header text-center">
                            <h4 class="text-orange-goto"><b>GTP309: Puno & Lake Titicaca</b></h4>
                        </div>
                        <div class="box-option-footer bg-grey-goto padding-5 text-center">
                            <h5 class="text-white">Plan A: Personalizacion 1</h5>
                        </div>
                    </a>
                </div>
                <div class="item box-option">
                    <a href="" class="">
                        <div class="box-option-header text-center">
                            <h4 class="text-orange-goto"><b>GTP309: Puno & Lake Titicaca</b></h4>
                        </div>
                        <div class="box-option-footer bg-grey-goto padding-5 text-center">
                            <h5 class="text-white">Plan A: Personalizacion 1</h5>
                        </div>
                    </a>
                </div>
                <div class="item box-option">
                    <a href="" class="">
                        <div class="box-option-header text-center">
                            <h4 class="text-orange-goto"><b>GTP309: Puno & Lake Titicaca</b></h4>
                        </div>
                        <div class="box-option-footer bg-grey-goto padding-5 text-center">
                            <h5 class="text-white">Plan A: Personalizacion 1</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <h4 class="font-montserrat text-orange-goto">
                {{--<span class="label bg-orange-goto">1</span>--}}
                Destinos</h4>
            <div class="divider margin-bottom-20"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1"> Lima
            </label>
        </div>
        <div class="col-md-3">
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1"> Nazca
            </label>
        </div>
        <div class="col-md-3">
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1"> Cusco
            </label>
        </div>
        <div class="col-md-3">
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1"> Sacred Valley
            </label>
        </div>
        <div class="col-md-3">
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1"> Ica
            </label>
        </div>
        <div class="col-md-3">
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1"> Machu Picchu
            </label>
        </div>
        <div class="col-md-3">
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1" value="option1"> Puno
            </label>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="font-montserrat text-orange-goto">
                {{--<span class="label bg-orange-goto">1</span>--}}
                Itinerario & Services</h4>
            <div class="divider margin-bottom-20"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="grid">
                <div class="box-sortable margin-bottom-10">
                    <a class="btn btn-link" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <b>Dia 1:</b> Peru full day
                    </a>
                    {{--<span class="pull-right">($1299.00)</span>--}}
                    <span class="label label-success pull-right">($1299.00)</span>
                    <div class="collapse clearfix" id="collapseExample">
                        <div class="col-md-12">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad adipisci fugit, ipsam numquam odit qui ratione rerum suscipit ullam voluptatibus? Beatae, eius error expedita qui quo suscipit tempore voluptatibus! Deserunt!
                            <h5><b>Services</b></h5>
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr class="bg-grey-goto text-white">
                                    <th colspan="2">Concepts</th>
                                    <th>Prices</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Transfer</td>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                    <td>1299.00</td>
                                    <td>
                                        <a href="" class="text-16 text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="" colspan="4">
                                        <a href="#add-services1" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">Add new services <i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                                        <div class="collapse" id="add-services1">
                                            <div class="row margin-top-10">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Services">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 row">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Price">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-sortable margin-bottom-10">
                    <a class="btn btn-link" role="button" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                        <b>Dia 2:</b> Peru full day
                    </a>
                    <span class="label label-success pull-right">($1899.00)</span>
                    <div class="collapse clearfix" id="collapseExample2">
                        <div class="col-md-12">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias animi aperiam, consectetur cum dicta distinctio eligendi libero, magnam minus nemo nisi nulla pariatur quod? At aut distinctio maxime optio suscipit?
                            <h5><b>Services</b></h5>
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr class="bg-grey-goto text-white">
                                    <th colspan="2">Concepts</th>
                                    <th>Prices</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Transfer</td>
                                    <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                    <td>1299.00</td>
                                    <td>
                                        <a href="" class="text-16 text-danger"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="" colspan="3">
                                        <a href="#add-services2" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample">Add new services <i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                                        <div class="collapse" id="add-services2">
                                            <div class="row margin-top-10">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Services">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 row">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control input-sm" id="txt_code" name="txt_code" placeholder="Price">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <a href="" class="btn btn-success btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <b class="font-montserrat">COST WITHOUT HOTELS $987 P.P</b>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h4 class="font-montserrat text-orange-goto">
                {{--<span class="label bg-orange-goto">1</span>--}}
                Hotels</h4>
            <div class="divider margin-bottom-10"></div>
        </div>
    </div>

    <div class="row margin-bottom-10">
        <div class="col-md-12 text-40 text-center">
            <b>
                <i class="fa fa-male" aria-hidden="true"></i>
                <i class="fa fa-male" aria-hidden="true"></i>
                <i class="fa fa-male" aria-hidden="true"></i>
                <i class="fa fa-male" aria-hidden="true"></i>
                <i class="fa fa-male" aria-hidden="true"></i>
                <span class="text-pink-goto">: 5</span>
            </b>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="divider margin-bottom-10"></div>
        </div>
    </div>

    <div class="row margin-bottom-10">
        <div class="col-md-3">
            <div class="checkbox checkbox-warning">
                <input id="checkbox1" type="checkbox" checked="">
                <label for="checkbox1">
                    <b class="text-16">2 Stars</b>
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="checkbox checkbox-warning">
                <input id="checkbox2" type="checkbox" checked="">
                <label for="checkbox2">
                    <b class="text-16">3 Stars</b>
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="checkbox checkbox-warning">
                <input id="checkbox3" type="checkbox" checked="">
                <label for="checkbox3">
                    <b class="text-16">4 Stars</b>
                </label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="checkbox checkbox-warning">
                <input id="checkbox4" type="checkbox" checked="">
                <label for="checkbox4">
                    <b class="text-16">5 Stars</b>
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="divider margin-bottom-20"></div>
        </div>
    </div>

    <div class="row margin-bottom-10">
        <div class="col-md-3">
            <div class="col-md-4 no-padding">
                <input type="number" class="form-control" min="0" max="99" step="1">
            </div>
            <div class="col-md-8">
                <img src="{{asset('img/icons/single.png')}}" alt="" width="35">
            </div>
        </div>
        <div class="col-md-3">
            <div class="col-md-4 no-padding">
                <input type="number" class="form-control" min="0" max="99" step="1">
            </div>
            <div class="col-md-8">
                <img src="{{asset('img/icons/single.png')}}" alt="" width="35">
                <img src="{{asset('img/icons/single.png')}}" alt="" width="35">
            </div>
        </div>
        <div class="col-md-3">
            <div class="col-md-4 no-padding">
                <input type="number" class="form-control" min="0" max="99" step="1">
            </div>
            <div class="col-md-8">
                <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="60">
            </div>
        </div>
        <div class="col-md-3">
            <div class="col-md-4 no-padding">
                <input type="number" class="form-control" min="0" max="99" step="1">
            </div>
            <div class="col-md-8">
                <img src="{{asset('img/icons/single.png')}}" alt="" width="35">
                <img src="{{asset('img/icons/single.png')}}" alt="" width="35">
                <img src="{{asset('img/icons/single.png')}}" alt="" width="35">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-right">
            <a class="" role="button" data-toggle="collapse" href="#edit-hotel" aria-expanded="false" aria-controls="collapseExample">
                <b class="font-montserrat">Edit hotel prices <i class="fa fa-arrow-down" aria-hidden="true"></i></b>
            </a>
            <div class="collapse" id="edit-hotel">
                <div class="well margin-top-20">
                    <div class="row">
                        <table class="table">
                            <thead>
                            <tr class="">
                                <th class="text-11 white-text">ROOMS</th>
                                <th class="text-11 white-text">ACOMODACION</th>
                                <th class="text-center">
                                    <div class="checkbox checkbox-warning">
                                        <input id="checkbox3" type="checkbox" checked="">
                                        <label for="checkbox3">
                                            <b class="text-16">2 Stars</b>
                                        </label>
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div class="checkbox checkbox-warning">
                                        <input id="checkbox3" type="checkbox" checked="">
                                        <label for="checkbox3">
                                            <b class="text-16">3 Stars</b>
                                        </label>
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div class="checkbox checkbox-warning">
                                        <input id="checkbox3" type="checkbox" checked="">
                                        <label for="checkbox3">
                                            <b class="text-16">4 Stars</b>
                                        </label>
                                    </div>
                                </th>
                                <th class="text-center">
                                    <div class="checkbox checkbox-warning">
                                        <input id="checkbox3" type="checkbox" checked="">
                                        <label for="checkbox3">
                                            <b class="text-16">5 Stars</b>
                                        </label>
                                    </div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <th>
                                        <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                                    </th>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <th>
                                        <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                                        <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                                    </th>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <th>
                                        <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="50">
                                    </th>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <th>
                                        <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                                        <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                                        <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                                    </th>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control text-right" min="0" max="99" step="1" value="0">
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button class="btn btn-lg btn-success" type="submit">Update Prices</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="divider margin-bottom-20"></div>
        </div>
    </div>



    <div class="row">

        <div class="col-md-12">
            <b class="font-montserrat text-pink-goto">
                {{--<span class="label bg-orange-goto">1</span>--}}
                Precio 3 estrellas</b>
            <table class="table table-condensed font-montserrat">
                {{--<caption>table title and/or explanatory text</caption>--}}
                <thead>
                    <tr>
                        <th><b class="text-grey-goto-light">Per Person</b></th>
                        <th></th>
                        <th class="text-right col-md-2"><b class="text-pink-goto text-20">Price</b></th>
                        <th class="text-right col-md-2"><b class="text-danger text-20">Cost</b></th>
                        <th class="text-right col-md-2"><b class="text-success text-20">Profit</b></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="text-16">$1899.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$1899.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$1899.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="text-16">$1899.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$1899.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$1899.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/matrimonial.png')}}" alt="" width="50">
                        </td>
                        <td class="text-right">
                            <b class="text-16">$1899.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$1899.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$1899.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                            <i class="fa fa-male fa-2x" aria-hidden="true"></i>
                        </td>
                        <td>
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                            <img src="{{asset('img/icons/single.png')}}" alt="" width="30">
                        </td>
                        <td class="text-right">
                            <b class="text-16">$1899.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$1899.00</b>
                        </td>
                        <td class="text-right">
                            <b class="text-16">$1899.00</b>
                        </td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td>

                        </td>
                        <td class="text-right">
                            <b class="text-20 text-pink-goto">100%</b>
                        </td>
                        <td class="text-right">
                            <b class="text-20 text-danger">40%</b>
                        </td>
                        <td class="text-right">
                            {{--<div>--}}
                                {{--<input type="number" class="form-control text-right" min="0" max="99" step="1">--}}
                            {{--</div>--}}
                            <div class="input-group has-success">
                                <input type="number" class="form-control input-porcent text-right" value="60">
                                <span class="input-group-addon input-" id="basic-addon2">%</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <button class="btn btn-lg btn-danger pull-left" type="submit">Generate PDF</button>
            <button class="btn btn-lg btn-success pull-right" type="submit">Send</button>
        </div>
    </div>


@stop