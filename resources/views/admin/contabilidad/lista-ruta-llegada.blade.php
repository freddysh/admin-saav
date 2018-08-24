<label for="txt_price">Ruta de llegada</label>
<select class="form-control" id="txt_ruta_llegada_{{$pos}}" name="txt_ruta_llegada_{{$pos}}">
        @if($punto_inicio=='CUSCO')
            <option value="AGUAS CALIENTES">AGUAS CALIENTES</option>
            <option value="OLLANTAYTAMBO">OLLANTAYTAMBO</option>
            <option value="PUNO">PUNO</option>
        @endif
        @if($punto_inicio=='MACHUPICCHU')
            <option value="OLLANTAYTAMBO">OLLANTAYTAMBO</option>
            <option value="POROY">POROY</option>
            <option value="CUSCO STATION">CUSCO STATION</option>
        @endif
        @if($punto_inicio=='SACRED VALLEY')
            <option value="AGUAS CALIENTES">AGUAS CALIENTES</option>
            <option value="POROY">POROY</option>
        @endif
</select>