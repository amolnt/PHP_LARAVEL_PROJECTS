<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
@section('pageContent')
	 <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add/Edit State</h2>
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
          



                        <label class="alert-success" id="succMsg" style="margin-left:30%;">
                                                      </label>

                      <label class="alert-danger" id="errorMsg" style="margin-left:-3%;">
                                                      </label>
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
                <fieldset>
                  <legend>Add new state</legend>
                  <a style="height:30px; padding-top:0%;" class="btn btn-primary addState" data-toggle="collapse" data-target="#add"><i class="fa fa-plus"></i> <span>Add new</span></a>
                <form method="post" action="{{action('AdminAddOperationController@addState',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <div id="add" class="collapse" class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <!--div class="form-group">
                              <label class="control-label col-md-3" name="discription" for="first-name">State Id</label>
                              <div class="col-md-7">
                                  <input type="number" id="addState_id" name="addState_id" class="form-control col-md-7 col-xs-12">
                              </div>
                            </div-->
                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">State Name</label>
                              <div class="col-md-7">
                                      <input type="text" id="addState_name" name="addState_name" class="form-control col-md-7 col-xs-12" required>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3" name="discription" for="first-name">State Code</label>
                              <div class="col-md-7">
                                      <input type="text" id="addState_code" name="addState_code" class="form-control col-md-7 col-xs-12" required>
                              </div>
                            </div>
                           <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" type="reset">Reset</button>
                            <input type="submit" class="btn btn-success" value="Submit">
                          </div>
                        </div>  
                         </form>
                </fieldset>
                <br>
                <div id="show">
                <fieldset id="edit" class="collapse">
                  <legend>Edit State</legend>
                <form method="post" action="{{action('AdminEditOperationController@updateState',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <div class="form-group">
                              <label class="control-label col-md-3" name="discription" for="first-name">State Id</label>
                              <div class="col-md-7">
                                  <input type="number" id="editState_id" name="editState_id" class="form-control col-md-7 col-xs-12" readonly>
                              </div>
                            </div>
                          
                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">State Name</label>
                              <div class="col-md-7">
                                      <input type="text" id="editState_name" name="editState_name" class="form-control col-md-7 col-xs-12" required>
                              </div>
                            </div>
  
                            <div class="form-group">
                              <label class="control-label col-md-3" name="discription" for="first-name">State Code</label>
                              <div class="col-md-7">
                                <input type="text" id="editState_code" name="editState_code" class="form-control col-md-7 col-xs-12" required>
                              </div>
                            </div>
                            <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" data-toggle="collapse" data-target="#edit" type="reset">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Update">
                          </div>
                        </div>
                         </form>
                      </fieldset>
                      </div>
                      <br>
                <legend>State</legend>
                <fieldset>
                <legend>show State</legend>
				<form method="post" enctype="multipart/form-data" class="form-horizontal form-label-left">
          		<input type="hidden" name="_token" value="{{csrf_token()}}">
					<table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                         <th>State id</th>
                          <th>State Name</th>
                          <th>State Code</th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody>

                        @if(isset($state))
                        	@foreach($state as $key =>$value)

                        		<tr>
                        		<td>{{$value['state_id']}}</td>
                        		<td>{{$value['state_name']}}</td>
                        		<td>{{$value['state_code']}}</td>
                        		<td>
                        			<a  style="height:25px; padding-top:0%;" class="btn btn-primary btn-xs editState" data-toggle="collapse" data-target="#edit"><i class="fa fa-edit"></i> <span>Edit</span></a></td>
                        		</tr>
                        	@endforeach	
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
        <script type="text/javascript">
        	// $('.addState').click(function(){        
   				//$('#add').modal('show');
    		//});
    		$('.editState').click(function(){ 
    			$('#editState_id').val($(this).parent().siblings('td').eq(0).text());
    			$('#editState_name').val($(this).parent().siblings('td').eq(1).text());
    			$('#editState_code').val($(this).parent().siblings('td').eq(2).text());
   				//$('#edit').modal('show');
          $('html, body').animate({
              scrollTop: $("#show").offset().top
          }, 2000);
    		});  
        </script>
@endsection
