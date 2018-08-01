@extends('layouts.admin.admin')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-white m-0">
            <li class="breadcrumb-item" aria-current="page"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Inventory</li>
        </ol>
    </nav>
    <hr>
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="row">
                <div class="col">
                    <h4 class="text-g-yellow">COST</h4>
                </div>
                <div class="col">
                    <h4 class="text-g-yellow">ITINERARY</h4>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col">
                                <h5 class="text-secondary">PRODUCTOS</h5>
                                <div class="row text-center">
                                    <div class="col">
                                        <a href="{{route("service_index_path")}}" class="btn btn-light">
                                            <img src="{{asset('images/icons/list.png')}}" alt="" class="" width="100%" height="60">
                                            <small class="display-block">List</small>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{route('nuevo_producto_path')}}" class="btn btn-light">
                                            <img src="{{asset('images/icons/new.png')}}" alt="" class="" width="100%" height="60">
                                            <small class="display-block">New</small>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{route('category_index_path')}}" class="btn btn-light">
                                            <img src="{{asset('images/icons/category.png')}}" alt="" class="" width="100%" height="60">
                                            <small class="display-block">Category</small>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h5 class="text-secondary">PROVIDER</h5>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <a href="{{route("provider_index_path")}}" class="btn btn-light">
                                            <img src="{{asset('images/icons/list.png')}}" alt="" class="" width="100%" height="60">
                                            <small class="display-block">List</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h5 class="text-secondary">COST</h5>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <a href="{{route("costs_index_path")}}" class="btn btn-light">
                                            <img src="{{asset('images/icons/list.png')}}" alt="" class="" width="100%" height="60">
                                            <small class="display-block">List</small>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="{{route("mostrar_cost_new_path")}}" class="btn btn-light">
                                            <img src="{{asset('images/icons/new.png')}}" alt="" class="" width="100%" height="60">
                                            <small class="display-block">New</small>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col d-flex">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col">
                                <h5 class="text-secondary">DAY BY DAY</h5>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <a href="{{route("itinerari_index_path")}}" class="btn btn-light w-100">
                                            <img src="{{asset('images/icons/list.png')}}" alt="" class="w-100" height="60">
                                            <small class="display-block">List</small>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="{{route('daybyday_new_path')}}" class="btn btn-light w-100">
                                            <img src="{{asset('images/icons/new.png')}}" alt="" class="w-100" height="60">
                                            <small class="display-block">New</small>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="{{route('destination_index_path')}}" class="btn btn-light w-100">
                                            <img src="{{asset('images/icons/location.png')}}" alt="" class="w-100" height="60">
                                            <small class="display-block">Destina...  </small>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <h5 class="text-secondary">PROGRAMS</h5>
                                <div class="row text-center">
                                    <div class="col-4">
                                        <a href="{{route("show_itineraries_path")}}" class="btn btn-light">
                                            <img src="{{asset('images/icons/list.png')}}" alt="" class="" width="100%" height="60">
                                            <small class="display-block">List</small>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a href="{{route("package_create_path")}}" class="btn btn-light">
                                            <img src="{{asset('images/icons/new.png')}}" alt="" class="" width="100%" height="60">
                                            <small class="display-block">New</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="row d-none">
        <div class="col">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="cost-tab" data-toggle="tab" href="#cost" role="tab" aria-controls="cost" aria-selected="true">Cost</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="itin-tab" data-toggle="tab" href="#itin" role="tab" aria-controls="itin" aria-selected="false">Itinerary</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="cost" role="tabpanel" aria-labelledby="cost-tab">

                    <div class="row justify-content-center mt-5">
                        <div class="col-9">
                            <div class="row">
                                <div class="col">
                                    <div class="card text-center bg-light">
                                        <div class="row">
                                            <div class="col">
                                                <div class="p-3">
                                                    <h5>PRODUCTOS</h5>
                                                    <a href="{{route("service_index_path")}}" data-toggle="tooltip" data-placement="left" title="List" class="text-success m-2"><i class="fas fa-list"></i></a>
                                                    <a href="{{route('nuevo_producto_path')}}" data-toggle="tooltip" data-placement="left" title="New" class=" m-2"><i class="fas fa-plus-circle"></i></a>
                                                    <a href="{{route('category_index_path')}}" data-toggle="tooltip" data-placement="left" title="Category" class="text-danger m-2"><i class="fas fa-check"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card text-center bg-light">
                                        <div class="row">
                                            <div class="col">
                                                <div class="p-3">
                                                    <h5>PROVIDER</h5>
                                                    <a href="{{route("provider_index_path")}}" data-toggle="tooltip" data-placement="left" title="List" class="text-success m-2"><i class="fas fa-list"></i></a>
                                                    {{--                                                                    <a href="{{route("package_create_path")}}" data-toggle="tooltip" data-placement="left" title="New" class="m-2"><i class="fas fa-plus-circle"></i></a>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card text-center bg-light">
                                        <div class="row">
                                            <div class="col">
                                                <div class="p-3">
                                                    <h5>COST</h5>
                                                    <a href="{{route("costs_index_path")}}" data-toggle="tooltip" data-placement="left" title="List" class="text-success m-2"><i class="fas fa-list"></i></a>
                                                    <a href="{{route("mostrar_cost_new_path")}}" data-toggle="tooltip" data-placement="left" title="New" class="m-2"><i class="fas fa-plus-circle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="itin" role="tabpanel" aria-labelledby="itin-tab">

                    <div class="row m-5">
                        <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link rounded-0 active" id="eng" data-toggle="pill" href="#v-pills-eng" role="tab" aria-controls="v-pills-eng" aria-selected="false">English</a>
                                <a class="nav-link rounded-0" id="esp" data-toggle="pill" href="#v-pills-esp" role="tab" aria-controls="v-pills-esp" aria-selected="true">Español</a>
                                <a class="nav-link rounded-0" id="port" data-toggle="pill" href="#v-pills-port" role="tab" aria-controls="v-pills-port" aria-selected="false">Portugues</a>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-eng" role="tabpanel" aria-labelledby="eng">

                                    <div class="row justify-content-center">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="card text-center bg-light">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="p-3">
                                                                    <h5>DAY BY DAY</h5>
                                                                    <a href="{{route("itinerari_index_path")}}" data-toggle="tooltip" data-placement="left" title="List" class="text-success m-2"><i class="fas fa-list"></i></a>
                                                                    <a href="{{route('daybyday_new_path')}}" data-toggle="tooltip" data-placement="left" title="New" class=" m-2"><i class="fas fa-plus-circle"></i></a>
                                                                    <a href="{{route('destination_index_path')}}" data-toggle="tooltip" data-placement="left" title="Destinations" class="text-danger m-2"><i class="fas fa-map-marker-alt"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="card text-center bg-light">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="p-3">
                                                                    <h5>PROGRAMS</h5>
                                                                    <a href="{{route("show_itineraries_path")}}" data-toggle="tooltip" data-placement="left" title="List" class="text-success m-2"><i class="fas fa-list"></i></a>
                                                                    <a href="{{route("package_create_path")}}" data-toggle="tooltip" data-placement="left" title="New" class="m-2"><i class="fas fa-plus-circle"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="v-pills-esp" role="tabpanel" aria-labelledby="esp"></div>
                                <div class="tab-pane fade" id="v-pills-port" role="tabpanel" aria-labelledby="port">..g.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop