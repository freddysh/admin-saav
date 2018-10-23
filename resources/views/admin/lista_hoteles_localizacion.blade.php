@foreach($hoteles as $hotel)
    <div class="col">
        <input type="hidden" name="hotel_id_{{$hotel->estrellas}}" value="{{$hotel->id}}">
        <div class="custom-control custom-radio">
            <input type="radio" id="customRadio_{{$id}}_{{$hotel->estrellas}}" name="categoria_[]" class="custom-control-input" value="{{$hotel->estrellas}}">
            <label class="custom-control-label" for="customRadio_{{$id}}_{{$hotel->estrellas}}">{{$hotel->estrellas}} <i class="fas fa-star text-warning"></i></label>
        </div>
    </div>
@endforeach