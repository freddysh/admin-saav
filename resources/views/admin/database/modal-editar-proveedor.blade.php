@php
    $nrocoincidencias=0;
@endphp
<div class="modal bd-example-modal-lg" id="modal_edit_cost_{{$provider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('provider_edit_path')}}" method="post" id="service_save_id" enctype="multipart/form-data">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel"> <i class="fas fa-edit"></i> Edit Provider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card p-3">
                                    <div class="row text-left">
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="txt_codigo" class="text-secondary font-weight-bold">Codigo</label>
                                                <input type="text" class="form-control" id="txt_codigo" name="txt_codigo" value="{{($provider->codigo)}}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txt_tipo_proveedor" class="text-secondary font-weight-bold">Tipo proveedor</label>
                                                <select class="form-control" name="txt_tipo_proveedor_" id="txt_tipo_proveedor_">
                                                    <option value="EXTERNO" @if($provider->tipo_proveedor=='EXTERNO') selected @endif>EXTERNO</option>
                                                    <option value="PLANTA" @if($provider->tipo_proveedor=='PLANTA') selected @endif>PLANTA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="txt_tipo_pago_" class="text-secondary font-weight-bold">Forma de pago</label>
                                                <select class="form-control" name="txt_tipo_pago_" id="txt_tipo_pago_">
                                                    <option value="CONTADO" @if($provider->tipo_pago=='CONTADO') selected @endif>CONTADO</option>
                                                    <option value="CREDITO" @if($provider->tipo_pago=='CREDITO') selected @endif>CREDITO</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_codigo" class="text-secondary font-weight-bold">Origen</label>
                                                <select class="form-control" id="txt_localizacion_" name="txt_localizacion_">
                                                    @foreach($destinations as $destination)
                                                        <option value="{{$destination->destino}}" <?php if($grupo==$provider->grupo){if($provider->localizacion==$destination->destino) echo 'selected';}?>>{{$destination->destino}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="tipoServicio_" id="tipoServicio_" value="{{$grupo}}">
                                            </div>
                                        </div>
                                        @if($grupo=='HOTELS')
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="txt_codigo" class="text-secondary font-weight-bold">Categoria</label>
                                                    <select class="form-control" id="txt_categoria_" name="txt_categoria_">
                                                        <option value="2" @if($provider->categoria=='2') selected @endif>2 STARS</option>
                                                        <option value="3" @if($provider->categoria=='3') selected @endif>3 STARS</option>
                                                        <option value="4" @if($provider->categoria=='4') selected @endif>4 STARS</option>
                                                        <option value="5" @if($provider->categoria=='5') selected @endif>5 STARS</option>
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_codigo" class="text-secondary font-weight-bold">Ruc</label>
                                                <input type="text" class="form-control" id="txt_ruc_" name="txt_ruc_" placeholder="Ruc"  value="<?php if($grupo==$provider->grupo) echo $provider->ruc;?>">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_type" class="text-secondary font-weight-bold">Razon social</label>
                                                <input type="text" class="form-control" id="txt_razon_social_" name="txt_razon_social_" placeholder="Razon social" value="<?php if($grupo==$provider->grupo) echo $provider->razon_social;?>">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="txt_type" class="text-secondary font-weight-bold">Nombre comercial</label>
                                                <input type="text" class="form-control" id="txt_nombre_comercial_" name="txt_nombre_comercial_" placeholder="nombre comercial" value="<?php if($grupo==$provider->grupo) echo $provider->nombre_comercial;?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="txt_precio" class="text-secondary font-weight-bold">Direccion</label>
                                                <input type="text" class="form-control" id="txt_direccion_" name="txt_direccion_" placeholder="Direccion" value="<?php if($grupo==$provider->grupo) echo $provider->direccion;?>">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label for="txt_price" class="text-secondary font-weight-bold text-g-yellow">Plazo a pagar en dias</label>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" id="txt_plazo_" name="txt_plazo_" min="0" value="{{$provider->plazo}}">
                                                    </div>
                                                </div>
                                                <div class="col">
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
                                <div class="row mt-3 text-left">
                                    <div class="col-md-4">
                                        <div class="card p-3 bg-light">
                                            <div class="form-group">
                                                <label for="txt_price" class="text-secondary font-weight-bold">Cel. Reservas</label>
                                                <input type="text" class="form-control" id="txt_r_telefono_" name="txt_r_telefono_" placeholder="Celular" value="<?php if($grupo==$provider->grupo) echo $provider->r_telefono;?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_price">Email Reservas</label>
                                                <input type="text" class="form-control" id="txt_r_email_" name="txt_r_email_" placeholder="Email" value="<?php if($grupo==$provider->grupo) echo $provider->r_email;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card p-3 bg-light">
                                            <div class="form-group">
                                                <label for="txt_price" class="text-secondary font-weight-bold">Cel. Contabilidad</label>
                                                <input type="text" class="form-control" id="txt_c_telefono_" name="txt_c_telefono_" placeholder="Celular" value="<?php if($grupo==$provider->grupo) echo $provider->c_telefono;?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="txt_price">Email Contabilidad</label>
                                                <input type="text" class="form-control" id="txt_c_email_" name="txt_c_email_" placeholder="Email" value="<?php if($grupo==$provider->grupo) echo $provider->c_email;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card p-3 bg-light">
                                            <div class="form-group">
                                                <label for="txt_price" class="text-secondary font-weight-bold">Cel. Operaciones</label>
                                                <input type="text" class="form-control" id="txt_o_telefono_" name="txt_o_telefono_" placeholder="Celular" value="<?php if($grupo==$provider->grupo) echo $provider->o_telefono;?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_price">Email Operaciones</label>
                                                <input type="text" class="form-control" id="txt_o_email_" name="txt_o_email_" placeholder="Email" value="<?php if($grupo==$provider->grupo) echo $provider->o_email;?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col">
                                        <div class="card bg-light w-100">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="txt_product" class="text-secondary font-weight-bold">Cta corriente</label>
                                                    <select class="form-control" name="txt_banco_nombre_cta_corriente_" id="txt_banco_nombre_cta_corriente_">
                                                        <option value="0">Escoja una Entidad Bancaria</option>
                                                        @foreach($entidadBancaria as $entidadBancaria_)
                                                            <option value="{{$entidadBancaria_->id}}" @if($provider->banco_nombre_cta_corriente==$entidadBancaria_->id){{'selected'}} @endif>{{$entidadBancaria_->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    {{--<label for="txt_product" class="text-secondary font-weight-bold">Email Reservas</label>--}}
                                                    <input type="text" class="form-control" id="txt_banco_nro_cta_corriente_" name="txt_banco_nro_cta_corriente_" placeholder="Numero Cta Corriente" value="{{$provider->banco_nro_cta_corriente}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card bg-light w-100">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="txt_product" class="text-secondary font-weight-bold">Cta Interbancaria</label>
                                                    <select class="form-control" name="txt_banco_nombre_cta_cci_" id="txt_banco_nombre_cta_cci_">
                                                        <option value="0">Escoja una Entidad Bancaria</option>
                                                        @foreach($entidadBancaria as $entidadBancaria_)
                                                            <option value="{{$entidadBancaria_->id}}" @if($provider->banco_nombre_cta_cci==$entidadBancaria_->id){{'selected'}} @endif>{{$entidadBancaria_->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    {{--<label for="txt_product" class="text-secondary font-weight-bold">Email Reservas</label>--}}
                                                    <input type="text" class="form-control" id="txt_banco_nro_cta_cci_" name="txt_banco_nro_cta_cci_" placeholder="Numero Cta CCI" value="{{$provider->banco_nro_cta_cci}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 text-left">
                                    <div class="col">
                                        <div class="card p-3 bg-light">
                                            <div class="form-group">
                                                <label for="txt_codigo" class="text-secondary font-weight-bold">Lugares que opera</label>
                                            </div>
                                            <div class="row padding-10">
                                                
                                                @foreach($destinations as $destination)
                                                    @php
                                                        $nrocoincidencias=$destinos_opera->where('proveedor_id',$provider->id)->where('m_destinos_id',$destination->id)->count();
                                                    @endphp
                                                    <div class="col-2 form-group form-check">
                                                        <input type="checkbox" class="form-check-input" id="destinos_opera_{{$provider->id}}_{{$destination->id}}" name="destinos_opera_[]" value="{{$destination->id}}" @if($nrocoincidencias>0) {{'checked'}} @endif>
                                                        <label class="form-check-label" for="destinos_opera_{{$provider->id}}_{{$destination->id}}">{{$destination->destino}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($provider->grupo!='HOTELS')
                                    <div class="row mt-3 text-left">
                                        <div class="col">
                                            <div class="card p-3 bg-light">
                                                <div class="form-group">
                                                    <label for="txt_codigo" class="text-secondary font-weight-bold">Servicios que opera</label>
                                                </div>
                                                <div class="row padding-10">
                                                    @foreach($m_categories as $m_category)
                                                        @php
                                                            $nrocoincidencias=$grupos_opera->where('proveedor_id',$provider->id)->where('m_category_id',$m_category->id)->count();
                                                        @endphp
                                                        <div class="col-2 form-group form-check">
                                                            <input type="checkbox" class="form-check-input" id="grupos_opera_{{$provider->id}}_{{$m_category->id}}" name="grupos_opera_[]" value="{{$m_category->id}}" @if($nrocoincidencias>0) {{'checked'}} @endif>
                                                            <label class="form-check-label" for="grupos_opera_{{$provider->id}}_{{$m_category->id}}">{{$m_category->nombre}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
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