@php
    function fecha_peru($fecha){
        $fecha_temp='';
        $fecha_temp=explode('-',$fecha);
        return $fecha_temp[2].'/'.$fecha_temp[1].'/'.$fecha_temp[0];
    }
@endphp
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Profit'],
                @foreach($array_profit as $key => $array_profit_)
                ['{{ $key}}',{{ $array_profit_}}],
                @endforeach
            ]);
            var options = {
                title: 'Profit desde: {{fecha_peru($desde)}} hasta: {{fecha_peru($hasta)}}',
                is3D:true,
                tooltip:{isHtml:true},
            };
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            // var chart = new google.visualization.ColumnChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
    <div class="row">
        <div class="col-5">
            <table class="table table-bordered table-striped table-responsive dataTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Página</th>
                        <th>Profit</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $pos=1;
                    $total=0;
                @endphp
                @foreach($array_profit as $key => $array_profit_)
                    <tr>
                        <td>{{$pos}}</td>
                        <td>{{$key}}</td>
                        <td class="text-right text-secondary">{{number_format($array_profit_,2)}}</td>
                        <td><a target="_blank" href="{{route('lista_de_cotizaciones_path',[$key,$desde,$hasta,$filtro])}}"><i class="fas fa-eye text-primary"></i> </a></td>
                    </tr>
                    @php
                        $pos++;
                        $total+=$array_profit_;
                    @endphp
                @endforeach
                <tr>
                    <td colspan="2"><strong>TOTAL</strong></td>
                    <td class="text-right text-secondary"><strong>{{number_format($total,2)}}</strong></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-7">
            <div id="piechart" style="width: 480px; height: 400px;"></div>

        </div>
    </div>
