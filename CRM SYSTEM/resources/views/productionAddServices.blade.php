  @extends('master.master')
  @section('pageContent')
        <div class="right_col" role="main">
                      <div class="row">
                       <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="x_panel">
                           <div class="x_title">
                    @if(Session::has('succ') || Session::has('succ1'))
                  <div class="alert alert-success alert-dismissible fade in col-md-9" role="alert" id="succMsg">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>
                        @if(Session::has('succ'))
                            {{Session::get('succ')['succMsg'] }}
                        @endif
                        @if(Session::has('succ1'))
                            {{Session::get('succ1')['succMsg'] }}
                        @endif                                  
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
                  <div id="addService" class="collapse">
                  
                   <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('ProductionInventoryOperation@addServices',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    
                    <fieldset>
                      <legend>Add Services</legend>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Service Type<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <select  name="service_type" class="service_type form-control" required>
                              <option>--Select Type--</option>
                          </select>
                          </div>
                      </div>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Service Name<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <select  name="service_name" class="service_name form-control" required>
                              <option>--Select Type--</option>
                          </select>
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">SAC Code<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="sac_code" class="sac_code form-control" readonly="">
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>
                      
                      <div class="form-group ">
                        <label class="col-md-3 control-label">Service Description<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <textarea name="description" class="form-control" rows="3" id="item_description" required></textarea>
                            </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Service Charge<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="service_charge" class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>

                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary cancel">Cancel</button>
                          <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </div> 
                      
                      </fieldset>
                     </form>            
                  </div>
                  </div>

                  <div id="show1">
                  <div id="editService" class="collapse">
                  <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('ProductionInventoryOperation@updateServices',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    
                    <fieldset>
                      <legend>Edit Service</legend>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Service Type<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                          <input type="hidden" name="service_id" id="service_id">
                            <select  name="service_type" id="service_type" class="service_type form-control" required>
                              <option>--Select Type--</option>
                          </select>
                          </div>
                      </div>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Service Name<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <select  name="service_name" id="service_name" class="service_name form-control" required>
                              <option>--Select Type--</option>
                          </select>
                          </div>
                      </div>
                      
                      <div class="form-group ">
                        <label class="col-md-3 control-label">Service Description<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <textarea name="description" id="service_description" class="form-control" rows="3" id="item_description" required></textarea>
                            </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Service Charge<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="service_charge" id="service_charge" class="form-control" required>
                           <div class="help-block with-errors"></div>
                          </div>
                      </div>

                  
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary cancel">Cancel</button>
                          <button type="submit" class="btn btn-success">Save</button>
                        </div>
                      </div>
                     </fieldset>  
                     </form>            
                  </div>
                 </div> 

          
                  <a data-toggle="collapse" class="service btn btn-info btn-xs" data-target="#addService">Add Service</a>
                 <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Actions</th>
                          <th hidden>Service ID</th>
                          <th>Service Type</th>
                          <th>Service name</th>
                          <th>Service Description</th>
                          <th>Service Charge</th>
                         
                        </tr>
                      </thead>
                   
                      <tbody>
                  @if(isset($services))
                  @foreach($services as $key=>$value)
                        <tr>
                          <td>
                            <a data-toggle="collapse" class="service btn btn-info btn-xs"  data-target="#editService">Edit</a>
                          </td>
                          <td hidden>{{$value['service_id']}}</td>
                          <td>{{$value['type_name']}}</td>
                          <td>{{$value['service_description']}}</td>
                          <td>{{$value['description']}}</td>
                          <td>{{$value['service_charge']}}</td>
                         
                        </tr>
                  @endforeach
                  @endif
                      </tbody>
                  </table>
                  
                  </div> 
                </div>
                </div>
              </div>
             </div> 
        



    <script type="text/javascript">

          $('.cancel').click(function(){
              location.reload();
          });
          $(document).ready(function(){
            $('.service').click(function(){
                  $.ajax({
                      url:'/service_type/ajax',
                      type:"GET",
                      dataType:"json",
                      success:function(data){
                        $('.service_type').empty();
                        $.each(data, function(key, value) {
                            $('.service_type').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                      }
                  });
              });
            $('.service_type').on('change', function() {
            var typeID = $(this).val();
            if(typeID) {
                $.ajax({
                    url: '/service_name/ajax/'+typeID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {

                        
                        $('.service_name').empty();
                        $.each(data, function(key, value) {
                            $('.service_name').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    }
                });
            }else{
                $('.service_name').empty();
            }
        });
            $('.service_name').on('change', function() {
            var serviceID = $(this).val();
            if(serviceID) {
                $.ajax({
                    url: '/SAC/ajax/'+serviceID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      for(var i=0;i<data.length;i++){
                        $('.sac_code').val(data[0]);
                        $('.gst').val(data[1]);
                      }
                    }
                });
            }else{
                $('.sac_code').empty();
            }
        });
      });
        $('.service').click(function(){
            $('#service_id').val($(this).parents().siblings('td').eq(0).text());
            $('#service_type').val($(this).parents().siblings('td').eq(1).text());
            $('#service_name').val($(this).parents().siblings('td').eq(2).text());
            $('#service_description').val($(this).parents().siblings('td').eq(3).text());
            $('#service_charge').val($(this).parents().siblings('td').eq(4).text());
            

            $('html, body').animate({
              scrollTop: $("#show").offset().top
          }, 2000);
             $('html, body').animate({
              scrollTop: $("#show1").offset().top
          }, 2000);
        });
     
    </script>  
    <script type="text/javascript">
        
        $(document).ready(function() {
           $("html, body").animate({ scrollTop: 0 }, "slow");
        });
    </script> 

  <!--*****************************************Wizard End***************************************************/-->
  
   @endsection     
