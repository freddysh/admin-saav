<select class="form-control" id="txt_type_{{$pos}}" name="txt_type_{{$pos}}">
<option value="0">Escoja una clase</option>
@foreach($clases->where('estado','1') as $clase)
    <option value="{{$clase->clase}}">{{$clase->clase}}</option>
@endforeach
</select>