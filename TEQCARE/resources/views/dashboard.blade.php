@extends('master.master')
	@section('pageContent')
			<div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2></h2>
                   @if(Session::has('succMsg'))
                  <div class="alert alert-success alert-dismissible fade in col-md-9" role="alert" id="succMsg">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>
                        {{Session::get('succMsg') }}                                  
                    </strong>
                  </div>
                  @endif
                  @if(Session::has('errorMsg'))
                  <div class="alert alert-danger alert-dismissible fade in col-md-9" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>
                    {{ Session::get('errorMsg')}}
                    </strong>
                  </div>
                  @endif
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                <div class="row">
              <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Calls</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div id="chart1" style="height: 370px; width: 100%;"></div>

                  </div>
                </div>
              </div>
           
              </div>
           <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Place Order Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="chart2" style="height: 370px; width: 100%;"></div>
                  </div>
                </div>
              </div>
               

               
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Inventory Details </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="chart3" style="height: 370px; width: 100%;"></div>
                  </div>
                </div>
              </div>
        </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<script type="text/javascript">
  window.onload = function () {
/*************************************First Chart****************************************/

     $.ajax({ 
            url: '/dashboardBar/ajax/',
            type: "GET",
            dataType: "json",
            success:function(data) {

              var chart = new CanvasJS.Chart("chart1", {
              theme: "light2", // "light1", "light2", "dark1", "dark2"
              exportFileName: "bar Chart",
              exportEnabled: true,
              animationEnabled: true,
              title: {
                text: "Calls in "+(new Date()).getFullYear()
              },
              axisY: {
                title: "Count",
                includeZero: true
              },
              data: [{
                      type: "rangeColumn",
                      yValueFormatString: "#,##0",
                      xValueFormatString: "MMM YYYY",
                      toolTipContent: "{x}<br>Open: {y[0]}<br>Allocate: {y[1]}<br>Close: {y[2]}",
                      dataPoints: [   
                                    { x: new Date((new Date()).getFullYear(), 0), y: [data[0]['open'], data[0]['allocate'],data[0]['close']] },
                                    { x: new Date((new Date()).getFullYear(), 1), y: [data[1]['open'], data[1]['allocate'],data[1]['close']] },
                                    { x: new Date((new Date()).getFullYear(), 2), y: [data[2]['open'], data[2]['allocate'],data[2]['close']] },
                                    { x: new Date((new Date()).getFullYear(), 3), y: [data[3]['open'], data[3]['allocate'],data[3]['close']] },
                                    { x: new Date((new Date()).getFullYear(), 4), y: [data[4]['open'], data[4]['allocate'],data[4]['close']] },
                                    { x: new Date((new Date()).getFullYear(), 5), y: [data[5]['open'], data[5]['allocate'],data[5]['close']] },
                                    { x: new Date((new Date()).getFullYear(), 6), y: [data[6]['open'], data[6]['allocate'],data[6]['close']] },
                                    { x: new Date((new Date()).getFullYear(), 7), y: [data[7]['open'], data[7]['allocate'],data[7]['close']] },
                                    { x: new Date((new Date()).getFullYear(), 8), y: [data[8]['open'], data[8]['allocate'],data[8]['close']] },
                                    { x: new Date((new Date()).getFullYear(), 9), y: [data[9]['open'], data[9]['allocate'],data[9]['close']] },
                                    { x: new Date((new Date()).getFullYear(), 10), y: [data[10]['open'], data[10]['allocate'],data[10]['close']] },
                                    { x: new Date((new Date()).getFullYear(), 11), y: [data[11]['open'], data[11]['allocate'],data[11]['close']] }
                                ]
                    }]
              });
              chart.render();
            }
      });
   
/***************************End First Chart*************************************************/
/*******************************Second Chart*****************************************************/
    $.ajax({
            url: '/dashboardDoughnut/ajax/',
            type: "GET",
            dataType: "json",
            success:function(data) {
              var chart = new CanvasJS.Chart("chart2", {
                theme: "light2",
                exportFileName: "Doughnut Chart",
                exportEnabled: true,
                animationEnabled: true,
                title:{
                  text: "Yearly PlaceOrder"
                },
                legend:{
                  cursor: "pointer",
                  itemclick: explodePie
                },
                data: [{
                        type: "doughnut",
                        innerRadius: 90,
                        showInLegend: false,
                        toolTipContent: "<b>{name}</b>: {y} ",
                        indexLabel: "{name} - {y}",
                        dataPoints: [
                                      { y: data['laptop'], name: "Laptop" },
                                      { y: data['desktop'], name: "Desktop"},
                                      { y: data['tab'], name: "Tab" },
                                      { y: data['printer'], name: "Printer" },
                                      { y: data['scanner'], name: "Scanner" },
                                      { y: data['software'], name: "Software" },
                                      { y: data['network'], name: "Network Device" },
                                      { y: data['other'], name: "Other" }
                                    ]
                      }]
                });
                chart.render();
              }
      });

function explodePie (e) {
  if(typeof (e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded) {
    e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
  } else {
    e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
  }
  e.chart.render();
}
/**************************************End Second Chart*****************************************/

/*******************************************Third Chart******************************************/
   $.ajax({
            url: '/dashboardPie/ajax/',
            type: "GET",
            dataType: "json",
            success:function(data) {
            
              var chart = new CanvasJS.Chart("chart3", {
                theme: "light2",
                exportFileName: "Pie Chart",
                exportEnabled: true,
                animationEnabled: true,
                title: {
                  text: "Inventory"
                },
                data: [{
                        type: "pie",
                        indexLabelFontSize: 18,
                        radius: 80,
                        indexLabel: "{label} - {y}",
                        yValueFormatString: "###0",
                        click: explodePie,
                        dataPoints: [
                                      { y: data['laptop'], label: "Laptop" },
                                      { y: data['desktop'], label: "Desktop"},
                                      { y: data['tab'], label: "Tab" },
                                      { y: data['printer'], label: "Printer" },
                                      { y: data['scanner'], label: "Scanner" },
                                      { y: data['software'], label: "Software" },
                                      { y: data['network'], label: "Network Device" },
                                      { y: data['other'], label: "Other" }
                        ]
                }]
              });
              chart.render();
            }
    });

function explodePie(e) {
  for(var i = 0; i < e.dataSeries.dataPoints.length; i++) {
    if(i !== e.dataPointIndex)
      e.dataSeries.dataPoints[i].exploded = false;
  }
}
/********************************End Third Chard***************************************************/
}

</script>
<script src="{{asset('assets/js/canvasjs.min.js')}}"></script>
	@endsection
