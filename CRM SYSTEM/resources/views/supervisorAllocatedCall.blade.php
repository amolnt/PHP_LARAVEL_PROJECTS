<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
@section('import')
	<link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap-dropdownhover.min.css')}}" rel="stylesheet">
@endsection
@section('pageContent')
   <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Calls</h2>
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
                  <div class="allocateDiv">
                  <fieldset id="allocate" class="collapse">
                    <legend>Allocate Call</legend>
                    <form method="post" action="{{action('SupervisorOperation@updateAllocateCall',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          	<input type="text" id="call" name="call" hidden>

                             <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">To Engineer</label>
                              <div class="col-md-7">
                              <select class="form-control" name="engineer" id="engineer" required>
                                <option>--Select Engineer--</option>
                                @if(isset($user))
                                     @foreach($user as $key=>$value)
                                            <option value="{{$value['user_id']}}">{{$value['full_name'] }}</option>
                                        @endforeach
                                @endif
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Call Priority</label>
                              <div class="col-md-7">
                              <select class="form-control" name="priority" id="priority"  required>
                                <option>--Select Priority--</option>
                                  <option value="High">High</option>
                                  <option value="Medium">Medium</option>
                                  <option value="Low">Low</option>
                                </select>
                              </div>
                            </div>

                             <div class="form-group">
                        	<label class="control-label col-md-3" for="first-name">Schedule</label>
                          <div class="form-group col-md-7">
                                <div class="component-box"> 
          
          <!--Datepicker with left header example -->
          <div class="pmd-card pmd-z-depth pmd-card-custom-view">
            <div class="pmd-card-body"> 
              <div class="form-group pmd-textfield pmd-textfield-floating-label">
                <input type="text" id="schedule" name="schedule" data-header-left="true" class="form-control datepicker-left-header" required/>
                <div class="help-block with-errors"></div>
              </div>              
            </div>
          </div> <!--Datepicker with left header example end-->
        </div>
                          </div>
                     </div>

                          <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button  class="btn btn-primary" type="button" data-toggle="collapse" data-target="#allocate">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Allocate">
                          </div>
                        </div>
                        </form>
                  </fieldset>
                  </div>
                  <br>
                <legend>Calls</legend>
                <fieldset>
                <legend>Show Calls</legend>
        <form method="post"  enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <table id="datatable" class="table table-striped table-bordered"> 
                      <thead>
                        <tr>
                        <th>Actions</th>
                         <th hidden>Request Id</th>
                          <th>Equipment Type</th>
                          <th>Equipment Name</th>
                          <th>Area Name</th>
                          <th>By Organization Type</th> 
                          <th>By Organization Name</th>
                          <th>By Contact Person Name</th>
                          <th>Problem</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody style="max-width: 100%;">

                        @if(isset($call))
                          <?php
                            for($i=0;$i<count($call);$i++){
                            echo "<tr>";
                            echo "<td> 
        <a data-toggle=\"collapse\" class=\"allocate btn btn-primary btn-xs\" data-target=\"#allocate\"  ><span class=\"fa fa-edit\">Edit</span></a>
    </td>";
                            echo "<td hidden>".$call[$i]['call_id']."</td>";
                            echo "<td>".$call[$i]['equ_type']."</td>";
                            echo "<td>".$call[$i]['equ_name']."</td>";
                            echo "<td>".$call[$i]['area_name']."</td>";
                            echo "<td>".$call[$i]['organisation_type']."</td>";
                            echo "<td>".$call[$i]['organisation_name']."</td>";
                            echo "<td>".$call[$i]['contactPerson_name']."</td>";
                            echo "<td>".$call[$i]['problem']."</td>";
                            echo "<td><a readonly class=\"btn btn-success btn-xs\" >".$call[$i]['status']."</a></td>";
                            echo "</tr>";
                            //echo "<tr id=\"tb".$i."\" class=\"collapse\">";
                            //echo "<td colspan=\"9\"><table id=\"datatable\" class=\"table table-striped table-bordered tbl".$i."\"></table></td></tr>";

                          //  echo "<tr id=\"tb".$i."\" class=\"collapse\">";
                            //echo "<td colspan=\"9\"><table id=\"datatable\" class=\"table table-striped table-bordered tbl".$i."\"></table></td></tr>";
                          }
                          ?> 
                        @endif
                      </tbody>
                    </table>   
                  </form>
                  </fieldset>
                  </fieldset>
           </div>
         </div>
        </div>
       </div>
     </div>

     <script src="{{asset('assets/js/bootstrap-dropdownhover.min.js')}}"></script>

       <script type="text/javascript">
        $('.allocate').click(function(){
        	/*if($(this).parents().siblings('td').eq(5).text().length!=0){	
          		$('#lead').val($(this).parents().siblings('td').eq(0).text());
          		$('#owner').val($(this).parents().siblings('td').eq(6).text());
          		$('#assoLead').val($(this).parents().siblings('td').eq(1).text());
          		$('#subject').val("Follow-Up: "+$(this).parents().siblings('td').eq(6).text());     			
      		}*/
          $('#call').val($(this).parents().siblings('td').eq(0).text());
         
          $.ajax({
                url: '/supervisorGetAllocatedData/ajax/',
                data: {call:$(this).parents().siblings('td').eq(0).text()},
                type: "GET",
                dataType: "json",
                success:function(data) {

                  $('#engineer').val(data[0]['to_user_id']);
                  $("#priority option:contains(" + data[0]['priority'] + ")").attr('selected', 'selected');
                  $('#schedule').val(data[0]['schedule']);
                }
            });
          
          	$('html, body').animate({
              scrollTop: $('.allocateDiv').offset().top
          	}, 2000);
        });
        </script>
@endsection