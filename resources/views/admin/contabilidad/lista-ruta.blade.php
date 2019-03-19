<label>Ruta</label>
<select class="form-control" id="txt_ruta_salida_{{$pos}}" name="txt_ruta_salida_{{$pos}}">
        <option value="ESCOJA UNA RUTA-ESCOJA UNA RUTA">ESCOJA UNA RUTA</option>
        @if($punto_inicio=='LIMA')
                <option value="LIMA-AIRPORT">LIMA-AIRPORT</option>
                <option value="AIRPORT-LIMA">AIRPORT-LIMA</option>
                <option value="LIMA-ICA">LIMA-ICA</option>
        @elseif($punto_inicio=='CUSCO')
                <option value="CUSCO-AIRPORT">CUSCO-AIRPORT</option>
                <option value="CUSCO-OLLANTA">CUSCO-OLLANTA</option>
                <option value="CUSCO-POROY">CUSCO-POROY</option>
                <option value="CUSCO-STATION">CUSCO-STATION</option>
                <option value="CUSCO-VALLE">CUSCO-VALLE</option>
                <option value="CUSCO-URUBAMBA">CUSCO-URUBAMBA</option>
                <option value="AIRPORT-CUSCO">AIRPORT-CUSCO</option>
                <option value="POROY-CUSCO">POROY-CUSCO</option>
                <option value="STATION-CUSCO">STATION-CUSCO</option>
        @elseif($punto_inicio=='SACRED VALLEY')
                <option value="OLLANTA-CUSCO">OLLANTA-CUSCO</option>
                <option value="VALLE-CUSCO">VALLE-CUSCO</option>
                <option value="URUBAMBA-CUSCO">URUBAMBA-CUSCO</option>
        @elseif($punto_inicio=='PUNO')
                <option value="PUNO-AIRPORT">PUNO-AIRPORT</option>
                <option value="PUNO-BUS.STATION">PUNO-BUS.STATION</option>
                <option value="AIRPORT-PUNO">AIRPORT-PUNO</option>
                <option value="BUS.STATION-PUNO">BUS.STATION-PUNO</option>
        @elseif($punto_inicio=='AREQUIPA')
                <option value="AREQUIPA-AIRPORT">AREQUIPA-AIRPORT</option>
                <option value="AIRPORT-AREQUIPA">AIRPORT-AREQUIPA</option>
        @elseif($punto_inicio=='MACHUPICCHU')
                <option value="AGUAS CALIENTES-MACHUPICCHU">AGUAS CALIENTES-MACHUPICCHU</option>
                <option value="MACHUPICCHU-AGUAS CALIENTES">MACHUPICCHU-AGUAS CALIENTES</option>
        @endif
        <option value="TOUR-TOUR">TOUR</option>
</select>