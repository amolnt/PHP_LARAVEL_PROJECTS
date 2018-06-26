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
                    <h2>Today Tasks</h2>
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
                  <div id="show">
                  <fieldset id="edit" class="collapse">
                  <legend>Edit Work Charge</legend>
                <form method="post" action="{{action('MrkExecutiveOperation@updateTaskStatus',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" id="task" name="task">
                            <div class="form-group">
                              <label class="control-label col-md-3" name="discription" for="first-name">Update Status</label>
                              <div class="col-md-7">
                                <select name="status" class="form-control" id="status">
                                  <option>--Select Status--</option>
                                  <option value="Assign">Assign</option>
                                  <option value="Complete">Complete</option>
                                </select>
                              </div>
                            </div>
                          <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" data-toggle="collapse" data-target="#edit" type="reset">Cancel</button>
                            <input type="submit" class="btn btn-success" value="updateStatus">
                          </div>
                        </div>
                         </form>
                  </fieldset>
                  </div>
                  <br>
                  <br>
               <fieldset>
                <legend>Today Tasks</legend>
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
                          <th></th>
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
                             echo "<td><a  class=\"btn btn-primary btn-xs editTodayTask\" data-toggle=\"collapse\" data-target=\"#edit\"><i class=\"fa fa-edit\" ></i> <span>updateStatus</span></a></td></tr>";
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
        $('.editTodayTask').click(function(){
              $('#task').val($(this).parents().siblings('td').eq(0).text());  
              $("#status option:contains(" + $(this).parent().siblings('td').eq(6).text() + ")").attr('selected', 'selected');
            $('html, body').animate({
              scrollTop: $('#show').offset().top
            }, 2000);
        });
        </script>
@endsection