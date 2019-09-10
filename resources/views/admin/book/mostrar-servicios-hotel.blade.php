<div class="col">
    {{csrf_field()}}
    <select class="form-control" name="txt_destino" id="txt_destino" onchange="llamar_hoteles_reservas($(this).val(),'ch','{{$hotel->id}}')">
        @foreach($destinations as $destino)
            <option value="{{$destino->id}}_{{$destino->destino}}">{{$destino->destino}}</option>
        @endforeach
    </select>
    <div id="lista_hoteles_ch_{{$hotel->id}}" class="row mt-4">
        @foreach($hoteles as $hotel_)
            <div class="col">
                <input type="hidden" name="hotel_id_{{$hotel_->estrellas}}" value="{{$hotel_->id}}">
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio_{{$hotel->id}}_{{$hotel_->estrellas}}" name="categoria_[]" class="custom-control-input" value="{{$hotel_->estrellas}}">
                    <label class="custom-control-label" for="customRadio_{{$hotel->id}}_{{$hotel_->estrellas}}">{{$hotel_->estrellas}} <i class="fas fa-star text-warning"></i></label>
                </div>
            </div>
        @endforeach
    </div>
</div>