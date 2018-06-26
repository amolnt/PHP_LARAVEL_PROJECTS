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
                             <h2>Edit Asset</h2>
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
                 <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('SysAdminOperation@allocateAsset',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                         <div class="form-group">
                            <label class="col-md-3 control-label">Department <span class="required">*</span></label>
                              <div class='col-md-7 col-sm-6 col-xs-12'>
                            <select name="department" id="department" class="form-control" required>
                                <option>--Select Department--</option>
                                @if(isset($department))
                                  <?php
                                      for($i=0;$i<count($department);$i++){
                                        echo "<option value='".$department[$i]['dept_id']."'>".$department[$i]['dept_name']."</option>";
                                      }
                                  ?>
                                @endif
                          </select>
                      </div>
                         </div>

                          <div class="form-group">
                            <label class="col-md-3 control-label">Employee<span class="required">*</span></label>
                              <div class='col-md-7 col-sm-6 col-xs-12'>
                            <select name="employee" id="employee" class="form-control" required>
                                <option>--Select Employee--</option>
                              
                          </select>
                      </div>
                         </div>


                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3" for="first-name">Asset Type<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-9">
                          <select name="asset_type" id="asset_type" class="form-control" required>
                          <option>--Select Asset Type--</option>
                          <option value="Hardware">Hardware</option>
                          <option value="Dekstop">Dekstop</option>
                          <option value="Harddrive">Harddrive</option>
                          <option value="Laptop">Laptop</option>
                          <option value="Monitor">Monitor</option>
                          <option value="Network Device">Network Device</option>
                          <option value="Printer">Printer</option>
                          <option value="Server">Server</option>
                          <option value="Scanner">Scanner</option>
                          </select>
                         </div>
                      </div>


                      <div class="form-group ">
                        <label class="col-md-3 control-label">Asset<span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <select name="asset" id="asset" class="form-control" required>
                          <option>--Select Asset--</option>
                          </select>
                      </div>
                      </div>
                          
                      <div class="form-group">
                      <label class="col-md-3 control-label"> Location <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input  type="text" name="location" id="location" class="form-control" placeholder="Asset Address" required>
                      </div>
                      </div>

                       
                                   
                        
                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-3" for="first-name">Status<span class="required">*</span>
                        </label>
                        <div class="col-md-7 col-sm-7 col-xs-9">
                          <select name="status" id="status" class="form-control" required>
                          <option>--Select Asset Status--</option>
                          <option value="Active">Active</option>
                          <option value="Available">Available</option>
                          <option value="In Storage">In Storage</option>
                          <option value="In Use">In Use</option>
                          <option value="New">New</option>
                          <option value="Returned">Returned</option>
                          </select>
                         </div>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div> 
                   </form>
                  </div> 
                  </div>
                </div>
          </div>
        </div>
    <script type="text/javascript">
        
        $(document).ready(function() {
           $("html, body").animate({ scrollTop: 0 }, "slow");
        });
    </script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('assets/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
    
   <script>
    $('.myDatepicker2').datetimepicker({
        format: 'YYYY-DD-MM'
    });

    $('.editAsset').click(function(){
        $('#asset').val($(this).parent().siblings('td').eq(0).text());
        $('#asset_type').val($(this).parent().siblings('td').eq(1).text());
        $('#asset_name').val($(this).parent().siblings('td').eq(2).text());
        $('#asset_address').val($(this).parent().siblings('td').eq(3).text());
        $('#purchase_date').val($(this).parent().siblings('td').eq(4).text());
        $("#warranty_type option:contains(" + $(this).parent().siblings('td').eq(5).text() + ")").attr('selected', 'selected');
        $('#warranty_date').val($(this).parent().siblings('td').eq(6).text());
        $('#cost').val($(this).parent().siblings('td').eq(7).text());
        $("#status option:contains(" + $(this).parent().siblings('td').eq(8).text() + ")").attr('selected', 'selected');
        $('#description').val($(this).parent().siblings('td').eq(9).text());

         $('html, body').animate({
              scrollTop: $("#show").offset().top
          }, 2000);
    });
    $('select[name="asset_type"]').on('change', function() {
            $('#asset').empty();
            var assetName = $(this).val();
            if(assetName) {
                $.ajax({
                    url: '/getAsset/ajax/',
                    data:{asset:assetName},
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      $('#asset').append('<option>--Select Asset--</option>');
                      for(var i=0;i<data.length;i++){
                        $('#asset').append('<option value=\''+data[i]['asset_id']+'\'>'+data[i]['asset_name']+'-'+data[i]['asset_address']+'</option>');
                      }
                    }
                });
            }else{
              $('#asset').empty();
            }
        });

     $('select[name="department"]').on('change', function() {
            $('#employee').empty();
            var dept_id = $(this).val();
            if(dept_id) {
                $.ajax({
                    url: '/getSysAdminEmployee/ajax/',
                    data:{dept:dept_id},
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      $('#employee').append('<option>--Select Employee--</option>');
                      for(var i=0;i<data.length;i++){
                        $('#employee').append('<option value=\''+data[i]['emp_id']+'\'>'+data[i]['full_name']+'</option>');
                      }
                    }
                });
            }else{
              $('#employee').empty();
            }
        });
  </script>


   @endsection     