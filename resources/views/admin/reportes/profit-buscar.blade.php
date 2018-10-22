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
    <div id="piechart" style="width: 700px; height: 500px;"></div>
