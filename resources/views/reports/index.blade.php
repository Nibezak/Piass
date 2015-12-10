@extends('layouts.default')

@section('title')
<i class="fa fa-bar-chart"></i> Reporting module.
@stop
@section('description')
 Please use the right menu to choose the report you want
@stop

@section('content')
<div class="box-body">
                  <div class="row">
                    <div class="col-md-9">
                      <p class="text-center">
                         <canvas id="daily-reports" class="col-md-12"></canvas>
                         <span id="chart">
                           
                         </span>
                      </p>
                      <div class="chart-responsive">
                        <!-- Sales Chart Canvas -->
                        <canvas id="salesChart" height="190" width="753" style="width: 753px; height: 190px;"></canvas>
                      </div><!-- /.chart-responsive -->
                    </div><!-- /.col -->
                    
                    <div class="col-md-3">
                      @include('reports.rightmenu')
                    </div>
                 </div>
 </div>
 


  {{--  <h2>Drill Down</h2>

     @foreach ($totals as $index => $dailyIncome)
        <li><strong>{{ $dates[$index] }}</strong> ${{ $dailyIncome}}</li>
    @endforeach --}}
@stop

@section('footer')
        <script src="{{Url()}}/assets/js/Chart.min.js"></script>

    <script>
        (function() {
            var ctx = document.getElementById('daily-reports').getContext('2d');
           var chart = {
           labels: {!! $months !!},
    datasets: [
        {
            label: "Supposed be paid",
            fillColor: "#666",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: {!! $debits !!}
        },
        {
            label: "Paid",
            fillColor: "rgba(0,166,90,0.5)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: {!! $credits !!}
        }
    ]
};

//legendTemplate takes a template as a string, you can populate the template with values from your dataset 
var options = {
  legendTemplate :'<% for (var i=0; i<datasets.length; i++) { %>'
                    +'<small class="label" style=\"background-color:<%=datasets[i].fillColor%>;padding:5px;font-size:12px;\">'
                    +'<% if (datasets[i].label) { %><%= datasets[i].label %><% } %>'
                    +'</small>'
                  
                +'<% } %>'
             
  }

             //don't forget to pass options in when creating new Chart
  var lineChart = new Chart(ctx).Line(chart, options);

  //then you just need to generate the legend
  var legend = lineChart.generateLegend();

  //and append it to your page somewhere
  $('#chart').append(legend);
        })();
    </script>
 @stop