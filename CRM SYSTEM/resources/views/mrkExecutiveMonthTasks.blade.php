<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
@section('import')
    <style type="text/css">
     td {
            white-space: pre;
        }
    </style>
@endsection
@section('pageContent')
   <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Month Tasks</h2>
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
               <fieldset>
                <legend>Month Tasks</legend>
                 <table id="datatable" class="table table-striped table-bordered"> 
                      <thead>
                        <tr>
                         <th hidden>Task Id</th>
                          <th>Organization Name</th>
                          <th>Subject</th>
                          <th>Priority</th>
                          <th>Schedule Date</th>
                          <th>Discription</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody style="max-width: 100%;">

                        @if(isset($task))
                          <?php
                            for($i=0;$i<count($task);$i++){
                            echo "<tr>";
                            echo "<td hidden>".$task[$i]['task_id']."</td>";
                            echo "<td>".$task[$i]['organization_name']."</td>";
                            echo "<td>".$task[$i]['subject']."</td>";
                            echo "<td>".$task[$i]['priority']."</td>";
                            echo "<td>".$task[$i]['schedule']."</td>";
                            echo "<td>".$task[$i]['discription']."</td>";
                            echo "<td>".$task[$i]['status']."</td>";
                            echo "</tr>";
                          }
                          ?> 
                        @endif

                      </tbody>
                    </table>   
                  </fieldset>
                  </fieldset>
           </div>
         </div>
        </div>
       </div>
     </div>

     <script src="{{asset('assets/js/bootstrap-dropdownhover.min.js')}}"></script>

        <script type="text/javascript">
        $('.addTask').click(function(){
          if($(this).parents().siblings('td').eq(5).text().length!=0){  
              $('#lead').val($(this).parents().siblings('td').eq(0).text());
              $('#owner').val($(this).parents().siblings('td').eq(6).text());
              $('#assoLead').val($(this).parents().siblings('td').eq(1).text());
              $('#subject').val("Follow-Up: "+$(this).parents().siblings('td').eq(6).text());           
          }
            $('html, body').animate({
              scrollTop: $('.addTask').offset().top
            }, 2000);
        });
        </script>
@endsection