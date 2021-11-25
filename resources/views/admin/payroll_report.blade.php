@extends('layouts.main')
@section('content')

<div id="curve_chart" style="width: 900px; height: 500px"></div>



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Gross income', 'Allowance', 'Deduction'],
          ['Jan',  10000,    10000,      400],
          ['Feb',  10170,    9000,      460],
          ['Mar',  6060,     9500,    1120],
          ['Apr',  10030,    4000,      540]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
@endsection