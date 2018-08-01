
<table id="tb_HOTELS" class="table table-striped table-bordered table-responsive text-12" cellspacing="0" width="100%">
    <thead>
    <tr>
        @if($grupo=='HOTELS')
            <th class="col-lg-1">Cat</th>
        @endif
        <th class="col-lg-1">Codigo</th>
        <th class="col-lg-1">Ruc</th>
        <th class="col-lg-1">Razon social</th>
        <th class="col-lg-1">Nombre comercial</th>
        <th class="col-lg-1">Reservas</th>
        <th class="col-lg-1">Contabilidad</th>
        <th class="col-lg-1">Operaciones</th>
        <th class="col-lg-1">Plazo</th>
        <th class="col-lg-1">Opciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($proveedores->sortBy('nombre_comercial') as $provider)
        <tr id="lista_provider_{{$provider->id}}">
            @if($grupo=='HOTELS')
                <td>{{$provider->categoria}} Stars</td>
            @endif
            <td>{{$provider->codigo}}</td>
            <td>{{$provider->ruc}}</td>
            <td>{{$provider->razon_social}}</td>
            <td>{{$provider->nombre_comercial}}</td>
            <td>
                <b>Cel:</b>{{$provider->r_telefono}}<br>
                <b>Email:</b>{{$provider->r_email}}
            </td>
            <td>
                <b>Cel:</b>{{$provider->c_telefono}}<br>
                <b>Email:</b>{{$provider->c_email}}
            </td>
            <td>
                <b>Cel:</b>{{$provider->o_telefono}}<br>
                <b>Email:</b>{{$provider->o_email}}
            </td>
            <td>{{$provider->plazo}} dias {{$provider->desci}}</td>
            <td>
                <b href="!#" class="puntero text-warning"  data-toggle="modal" data-target="#modal_edit_cost_{{$provider->id}}">
                    <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i>
                </b>
                <div class="modal fade bd-example-modal-lg" id="modal_edit_cost_{{$provider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <form action="{{route('provider_edit_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Provider</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="tab-content">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="estilo_form_new clearfix">
                                                            <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="txt_codigo">Codigo</label>
                                                                                <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" value="{{($provider->codigo)}}" readonly>
                                                                            </div>
                                                                        </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_codigo">Location</label>
                                                                    <select class="form-control" id="txt_localizacion_" name="txt_localizacion_">
                                                                        @foreach($destinations as $destination)
                                                                            <option value="{{$destination->destino}}" <?php if($grupo==$provider->grupo){if($provider->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="hidden" name="tipoServicio_" id="tipoServicio_" value="{{$grupo}}">
                                                                </div>
                                                            </div>
                                                            @if($grupo=='HOTELS')
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="txt_codigo">Categoria</label>
                                                                        <select class="form-control" id="txt_categoria_" name="txt_categoria_">
                                                                            <option value="2" @if($provider->categoria=='2') selected @endif>2 STARS</option>
                                                                            <option value="3" @if($provider->categoria=='3') selected @endif>3 STARS</option>
                                                                            <option value="4" @if($provider->categoria=='4') selected @endif>4 STARS</option>
                                                                            <option value="5" @if($provider->categoria=='5') selected @endif>5 STARS</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_codigo">Ruc</label>
                                                                    <input type="text" class="form-control" id="txt_ruc_" name="txt_ruc_" placeholder="Ruc"  value="<?php if($grupo==$provider->grupo) echo $provider->ruc;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_type">Razon social</label>
                                                                    <input type="text" class="form-control" id="txt_razon_social_" name="txt_razon_social_" placeholder="Razon social" value="<?php if($grupo==$provider->grupo) echo $provider->razon_social;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="txt_type">Nombre comercial</label>
                                                                    <input type="text" class="form-control" id="txt_nombre_comercial_" name="txt_nombre_comercial_" placeholder="nombre comercial" value="<?php if($grupo==$provider->grupo) echo $provider->nombre_comercial;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label for="txt_precio">Direccion</label>
                                                                                <input type="text" class="form-control" id="txt_direccion_" name="txt_direccion_" placeholder="Direccion" value="<?php if($grupo==$provider->grupo) echo $provider->direccion;?>">
                                                                            </div>
                                                                        </div>
                                                            <div class="col-md-4">
                                                                <label for="txt_price">Plazo a pagar en dias</label>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="col-lg-1 form-control" id="txt_plazo_" name="txt_plazo_" min="0" value="{{$provider->plazo}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5  no-padding">
                                                                        <div class="form-group">
                                                                            <select class="form-control" id="txt_desci_" name="txt_desci_">
                                                                                <option value="antes" @if($provider->desci=='antes') selected @endif>Antes</option>
                                                                                <option value="despues" @if($provider->desci=='despues') selected @endif>Despues</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="estilo_form_new clearfix">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="txt_price">Cel. Reservas</label>
                                                                    <input type="text" class="form-control" id="txt_r_telefono_" name="txt_r_telefono_" placeholder="Celular" value="<?php if($grupo==$provider->grupo) echo $provider->r_telefono;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="txt_price">Email Reservas</label>
                                                                    <input type="text" class="form-control" id="txt_r_email_" name="txt_r_email_" placeholder="Email" value="<?php if($grupo==$provider->grupo) echo $provider->r_email;?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="estilo_form_new clearfix">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="txt_price">Cel. Contabilidad</label>
                                                                    <input type="text" class="form-control" id="txt_c_telefono_" name="txt_c_telefono_" placeholder="Celular" value="<?php if($grupo==$provider->grupo) echo $provider->c_telefono;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="txt_price">Email Contabilidad</label>
                                                                    <input type="text" class="form-control" id="txt_c_email_" name="txt_c_email_" placeholder="Email" value="<?php if($grupo==$provider->grupo) echo $provider->c_email;?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="estilo_form_new clearfix">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="txt_price">Cel. Operaciones</label>
                                                                    <input type="text" class="form-control" id="txt_o_telefono_" name="txt_o_telefono_" placeholder="Celular" value="<?php if($grupo==$provider->grupo) echo $provider->o_telefono;?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="txt_price">Email Operaciones</label>
                                                                    <input type="text" class="form-control" id="txt_o_email_" name="txt_o_email_" placeholder="Email" value="<?php if($grupo==$provider->grupo) echo $provider->o_email;?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    {{csrf_field()}}
                                    <input type="hidden" name="posTipoEditcost_{{$provider->id}}" id="posTipoEditcost_{{$provider->id}}" value="{{$provider->grupo}}">
                                    <input type="hidden" name="id" id="id" value="{{$provider->id}}">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <b href="!#" class="puntero text-danger" onclick="eliminar_provider('{{$provider->id}}','{{$provider->razon_social}}')">
                    <i class="fa fa-trash-o fa-2x" aria-hidden="true"></i>
                </b>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
