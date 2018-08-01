<label>Tipo</label>
<select class="form-control" id="txt_tipo_{{$pos}}" name="txt_tipo_{{$pos}}" onchange="mostrar_tabla_destino_ruta_tipo_datos('{{$grupo}}','{{$id}}',$('#txt_ruta_{{$pos}}').val(),$('#txt_tipo_{{$pos}}').val(),{{$pos}})">
        <option value="ESCOJA UN TIPO">ESCOJA UN TIPO</option>
        <option value="AUTO">AUTO</option>
        <option value="SUV">SUV</option>
        <option value="VAN">VAN</option>
        <option value="H1">H1</option>
        <option value="SPRINTER">SPRINTER</option>
        <option value="BUS">BUS</option>
</select>