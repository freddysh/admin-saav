<label for="txt_price">Ruta de salida</label>
<select class="form-control" id="txt_ruta_salida_{{$pos}}" name="txt_ruta_salida_{{$pos}}">
        @if($punto_inicio=='CUSCO')
                <option value="POROY">POROY</option>
        @endif
        @if($punto_inicio=='MACHUPICCHU')
                <option value="AGUAS CALIENTES">AGUAS CALIENTES</option>
        @endif
        @if($punto_inicio=='SACRED VALLEY')
                <option value="OLLANTAYTAMBO">OLLANTAYTAMBO</option>
        @endif
</select>