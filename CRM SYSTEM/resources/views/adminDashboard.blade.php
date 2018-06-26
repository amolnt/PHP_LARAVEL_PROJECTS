<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
  @section('pageContent')
<div class="right_col" role="main">
          <div class="">
            <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-group"></i> Total Employee</span>
              <div class="count" id="total_employee"></div>
              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
              <div class="count" id="total_males"></div>
             
            </div>
             <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Females </span>
              <div class="count" id="total_females"></div>
              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Department</span>
              <div class="count" id="total_department"></div>
              
            </div>
            
           
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Roles</span>
              <div class="count" id="total_role"></div>
              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Posts</span>
              <div class="count" id="total_post"></div>
            </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Employee</h2>
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
                    <h2>Department</h2>
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
                    <h2>Post</h2>
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
            <div class="clearfix"></div>
            <br />
          </div>
        </div>

  <script type="text/javascript">
   window.onload = function () {
      $.ajax({
            url: '/getITAdminCount/ajax/',
            type: "GET",
            dataType: "json",
            success:function(data) {
                $('#total_employee').text(data['total_employee']);
                $('#total_males').text(data['total_males']);
                $('#total_females').text(data['total_females']);
                $('#total_department').text(data['total_department']);
                $('#total_role').text(data['total_role']);
                $('#total_post').text(data['total_post']);
             }
      });
      /********************************First Chart********************************************/
      $.ajax({
            url: '/getMonthWiseEmployeeCreated/ajax/',
            type: "GET",
            dataType: "json",
            success:function(data) {
              
                var year=(new Date).getFullYear();
                var chart = new CanvasJS.Chart("chart1", {
                animationEnabled: true,
                theme: "light2",
                exportFileName: "Employee",
                exportEnabled: true,
                title: {
                  text: "Monthly Employee"
                },
                axisX: {
                  valueFormatString: "MMM"
                },
                axisY: {
                  prefix: "",
                  labelFormatter: addSymbols
                },
                toolTip: {
                  shared: true
                },
                legend: {
                  cursor: "pointer",
                  itemclick: toggleDataSeries
                },
                data: [
                {
                  type: "column",
                  name: "Total Employee",
                  showInLegend: true,
                  xValueFormatString: "MMMM YYYY",
                  yValueFormatString: "#,##0",
                  dataPoints: [
                    { x: new Date(year, 0), y: data[0]['total'] },
                    { x: new Date(year, 1), y: data[1]['total'] },
                    { x: new Date(year, 2), y: data[2]['total'] },
                    { x: new Date(year, 3), y: data[3]['total']},
                    { x: new Date(year, 4), y: data[4]['total']},
                    { x: new Date(year, 5), y: data[5]['total'] },
                    { x: new Date(year, 6), y: data[6]['total']},
                    { x: new Date(year, 7), y: data[7]['total'] },
                    { x: new Date(year, 8), y: data[8]['total']},
                    { x: new Date(year, 9), y:  data[9]['total']},
                    { x: new Date(year, 10), y: data[10]['total'] },
                    { x: new Date(year, 11), y: data[11]['total'] }
                  ]
                }, 
                {
                  type: "line",
                  name: "Males",
                  showInLegend: true,
                  yValueFormatString: "#,##0",
                  dataPoints: [
                    { x: new Date(year, 0), y: data[0]['male'] },
                    { x: new Date(year, 1), y: data[1]['male'] },
                    { x: new Date(year, 2), y: data[2]['male'] },
                    { x: new Date(year, 3), y: data[3]['male'] },
                    { x: new Date(year, 4), y: data[4]['male'] },
                    { x: new Date(year, 5), y: data[5]['male'] },
                    { x: new Date(year, 6), y: data[6]['male']},
                    { x: new Date(year, 7), y: data[7]['male'] },
                    { x: new Date(year, 8), y: data[8]['male'] },
                    { x: new Date(year, 9), y: data[9]['male'] },
                    { x: new Date(year, 10), y: data[10]['male'] },
                    { x: new Date(year, 11), y: data[11]['male'] }
                  ]
                },
                {
                  type: "area",
                  name: "Females",
                  markerBorderColor: "white",
                  markerBorderThickness: 2,
                  showInLegend: true,
                  yValueFormatString: "#,##0",
                  dataPoints: [
                    { x: new Date(year, 0), y: data[0]['female'] },
                    { x: new Date(year, 1), y: data[1]['female'] },
                    { x: new Date(year, 2), y: data[2]['female']},
                    { x: new Date(year, 3), y: data[3]['female']},
                    { x: new Date(year, 4), y: data[4]['female'] },
                    { x: new Date(year, 5), y: data[5]['female'] },
                    { x: new Date(year, 6), y: data[6]['female']},
                    { x: new Date(year, 7), y: data[7]['female'] },
                    { x: new Date(year, 8), y: data[8]['female'] },
                    { x: new Date(year, 9), y: data[9]['female']},
                    { x: new Date(year, 10), y: data[10]['female'] },
                    { x: new Date(year, 11), y: data[11]['female'] }
                  ]
                }]
              });
              chart.render();
             }
      });
    function addSymbols(e) {
      var suffixes = ["", "K", "M", "B"];
      var order = Math.max(Math.floor(Math.log(e.value) / Math.log(1000)), 0);

      if(order > suffixes.length - 1)                 
        order = suffixes.length - 1;

      var suffix = suffixes[order];      
      return CanvasJS.formatNumber(e.value / Math.pow(1000, order)) + suffix;
    }

    function toggleDataSeries(e) {
      if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
      } else {
        e.dataSeries.visible = true;
      }
      e.chart.render();
    }
    /*********************************End First Chart***************************************/


    /*********************************Second Chart******************************************/
     $.ajax({
            url: '/getDepartmentWiseEmployeeCount/ajax/',
            type: "GET",
            dataType: "json",
            success:function(data) {
                var chart = new CanvasJS.Chart("chart2", {
                    exportEnabled: true,
                    animationEnabled: true,
                    title:{
                      text: "Employee In Department"
                    },
                    legend:{
                      cursor: "pointer",
                      itemclick: explodePie
                    },
                    data: [{
                      type: "pie",
                      showInLegend: true,
                      toolTipContent: "{name}: <strong>{y}</strong>",
                      indexLabel: "{name} - {y}",
                      dataPoints: [
                        
                      ]
                    }]
                  });
                for(var i=0;i<data.length;i++){
                  chart.options.data[0].dataPoints.push({y :data[i]['count'], name: data[i]['dept_name']});
                }
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
    /***********************************End Second Chart************************************/

    /*******************************Third Chart*********************************************/
     $.ajax({
            url: '/getPostWiseEmployeeCount/ajax/',
            type: "GET",
            dataType: "json",
            success:function(data) {
                var chart = new CanvasJS.Chart("chart3", {
                theme: "light2",
                exportFileName: "Doughnut Chart",
                exportEnabled: true,
                animationEnabled: true,
                title:{
                  text: "Employee In Post"
                },
                legend:{
                  cursor: "pointer",
                  itemclick: explodePie
                },
                data: [{
                        type: "doughnut",
                        innerRadius: 90,
                        showInLegend: true,
                        toolTipContent: "<b>{name}</b>: {y} ",
                        indexLabel: "{name} - {y}",
                        dataPoints: [
                                      
                                    ]
                      }]
                });
                 for(var i=0;i<data.length;i++){
                  chart.options.data[0].dataPoints.push({y :data[i]['count'], name: data[i]['post_name']});
                }
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
    /*************************************End Third Chart***********************************/
  }
  </script>
@endsection