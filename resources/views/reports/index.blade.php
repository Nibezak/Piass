@extends('layouts.default')

@section('content')
<div class="box-body">
                  <div class="row">
                    <div class="col-md-9">
                      <p class="text-center">
                        <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
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
 
     <script src="{{Url()}}/assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
    <script src="{{Url()}}/assets/dist/js/pages/dashboard2.js" type="text/javascript"></script>
 @stop