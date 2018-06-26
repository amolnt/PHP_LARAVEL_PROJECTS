<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
@section('import')


<style style="text/css">
    .hoverTable{
    width:100%; 
    border-collapse:collapse; 
  }
  .hoverTable td{ 
    padding:7px; border:#4e95f4 1px solid;
  }
  /* Define the hover highlight color for the table row */
    .hoverTable tr:hover {
          background-color: #ffff99;
    }
</style>
@endsection
@section('pageContent')
   <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage Lead</h2>
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
                <br>
                <div class="changeOwner">
                  <fieldset id="changeOwner" class="collapse">
                    <legend>Change Owner</legend>
                    <form method="post" action="" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                        	<input type="hidden" id="leadOwnerKey" name="leadOwnerKey">
                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">New Stage</label>
                              <div class="col-md-7">
                                <select id="leadOwner" name="leadOwner" class="form-control" required>
                                <option>--Select Lead Stage--</option>
                                  <option value="Prospect">Prospect</option>
                                  <option value="Opportunity">Opportunity</option>
                                  <option value="Customer">Customer</option>
                                  <option value="Disqualified">Disqualified</option>
                                  <option value="Invalid">Invalid</option>
                              </select>
                              </div>
                            </div>
                          <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" data-toggle="collapse" data-target="#changeOwner" type="reset">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Update">
                          </div>
                        </div>
                          </div>
                          </div>
                        </form>
                  </fieldset>
                  </div>

                  <div class="addTask">
                  <fieldset id="addTask" class="collapse">
                    <legend>Add Task</legend>
                    <form method="post" action="{{action('MrkManagerOperation@addTask',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          	<input type="hidden" id="lead" name="lead">

                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Owner</label>
                              <div class="col-md-7">
                                <input type="text" class="form-control" id="owner" name="owner" readonly required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Associated Lead</label>
                              <div class="col-md-7">
                                <input type="text" class="form-control" id="assoLead" name="assoLead" readonly required>
                              </div>
                            </div>

                             <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Task Priority</label>
                              <div class="col-md-7">
                              <select class="form-control" name="priority" id="priority">
                                <option>--Select Priority--</option>
                                  <option value="High">High</option>
                                  <option value="Medium">Medium</option>
                                  <option value="Low">Low</option>
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Subject</label>
                              <div class="col-md-7">
                                <input type="text" class="form-control" id="subject" name="subject" required>
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
                <input type="text" name="schedule" data-header-left="true" class="form-control datepicker-left-header" required/>
                <div class="help-block with-errors"></div>
              </div>              
            </div>
          </div> <!--Datepicker with left header example end-->
        </div>
                          </div>
                     </div>

                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Discription</label>
                              <div class="col-md-7">    
                                <textarea name="discription" class="form-control" rows="3" id="discription" required></textarea>
                              </div>
                            </div>

                          <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" data-toggle="collapse" data-target="#addTask" type="reset">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Add Task">
                          </div>
                        </div>
                        </form>
                  </fieldset>
                  </div>
                  <br>
                <legend>Leads</legend>
                <fieldset>
                <legend>Show Leads</legend>
        <form method="post"  enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <table id="datatable" class="table table-striped table-bordered"> 
                      <thead>
                        <tr>
                        
                         <th hidden>Lead Id</th>
                          <th>Organization Name</th>
                          <th>Contact Person Name</th>
                          <th>Mobile No</th>
                          <th>Email</th> 
                          <th>Lead Stage</th>
                          <th>Owner</th>
                          <th hidden>Modify On</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody style="max-width: 100%;">

                        @if(isset($lead))
                          <?php
                            for($i=0;$i<count($lead);$i++){
                            echo "<tr>";
                           
                            echo "<td hidden>".$lead[$i]['lead_id']."</td>";
                            echo "<td>".$lead[$i]['organization_name']."</td>";
                            echo "<td>".$lead[$i]['contact_person_name']."</td>";
                            echo "<td>".$lead[$i]['mobile_no']."</td>";
                            echo "<td>".$lead[$i]['email']."</td>";
                            echo "<td>".$lead[$i]['status']."</td>";
                            echo "<td>".$lead[$i]['full_name']."</td>";
                            echo "<td hidden>".$lead[$i]['updated_at']."</td>";
                             echo "<td > <a class=\"col-md-1 actionResponse\" data-toggle=\"collapse\" data-target=\"#tb".$i."\" style=\"cursor:pointer\"><span class=\"fa fa-plus-circle\"> </span></a><ul style=\"list-style-type: none;\">              
                    <li class=\"dropdown\">
    <a style=\"cursor:pointer;\" class=\"dropdown-toggle hoverFunc col-md-1\" data-toggle=\"dropdown\" data-hover=\"dropdown\" data-delay=\"1000\" data-close-others=\"false\">
        <span class=\"fa fa-cog\"></span> <b class=\"caret\"></b>
    </a>
    <ul class=\"dropdown-menu\">
        <li><a data-toggle=\"collapse\" class=\"addTask\" data-target=\"#addTask\" >Add Task</a></li>
        <li><a data-toggle=\"collapse\" class=\"changeOwner\" data-target=\"#changeOwner\"  >Change Owner</a></li>
    </ul>
</li>
</ul></td>";
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
        $(document).ready(function(){
          $('.actionResponse').click('td', function () {

       
            var tr = $(this).closest('tr');
            var row = $('#datatable').DataTable().row(tr);

          if (row.child.isShown()) {
          // This row is already open - close it

            row.child.hide();
            tr.removeClass('shown');
          }
          else {
                  format(row.child,$(this).parents().siblings('td').eq(0).text());  // create new if not exist
                  tr.addClass('shown');
                }
            });
        });


        function format(callback,led){
          $.ajax({
                    url: '/getAction/ajax/'+led,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      
                        callback($('<table class="hoverTable" role=\"grid\" aria-describedby=\"datatable-fixed-header_info\">' + data + '</table>')).show();
                    }
                });
          }

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