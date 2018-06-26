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
                  <div id="show">
                  <fieldset id="editAsset" class="collapse">
                    <legend>Edit Asset</legend>
                      <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('SysAdminOperation@updateAsset',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden"  id="asset" name="asset">
                      <div class="form-group ">
                        <label class="col-md-3 control-label">Asset Name <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input type="text" name="asset_name" id="asset_name" class="form-control" placeholder="Asset Name" required>
                      </div>
                      </div>
                          

                      <div class="form-group ">
                        <label class="col-md-3 control-label">Model <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                          <select name="model" id="model" class="form-control">
                               <option value="">--Select Model--</option>
                                  @if(isset($model))
                                    <?php
                                        for ($i=0; $i <count($model) ; $i++) { 
                                          echo "<option value=\"".$model[$i]['model_id']."\">".$model[$i]['name'].'/'.$model[$i]['model_number']."</option>";
                                        }
                                    ?>
                                  @endif
                          </select>
                        </div>
                      </div>


                       <div class="form-group ">
                        <label class="col-md-3 control-label">Categoty <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                          <select name="category" id="category" class="form-control" required="">
                               <option value="">--Select Category--</option>
                               <option value="Mobile Phones">Mobile Phones</option>
                               <option value="Tablets">Tablets</option>
                               <option value="Laptops">Laptops</option>
                               <option value="Telephones">Telephones</option>
                               <option value="Desktop">Desktop</option>
                              </select>
                        </div>
                      </div>

                      <div class="form-group ">
                        <label class="col-md-3 control-label">Status <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                          <select name="status" id="status" class="form-control">
                            <option value="">--Select Status--</option>
                            <option value="Ready To Deploy">Ready To Deploy</option>
                            <option value="Working">Working</option>
                            <option value="Pendng">Pendng</option>
                            <option value="Out Of Diagnostic">Out Of Diagnostic</option>
                            <option value="Out Of Repaire">Out Of Repaire</option>
                             <option value="Broken-Not Flexible">Broken-Not Flexible</option>
                          </select>
                          <span id="msg" hidden="">

If you wish to assign this asset immediately, select "Ready to Deploy" from the status list above.
</span>
                        </div>
                      </div>

                      <div id="assign" hidden="">
                          <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Employee </label>
                              <div class="col-md-7">
                                <select class="form-control" name="employee" id="employee" >
                                <option value="">--Select Employee--</option>
                                @if(isset($employee))
                                  @foreach($employee as $key=>$value)
                                    <option value="{{$value['emp_id']}}">{{$value['full_name']}}</option>
                                  @endforeach
                                @endif
                                </select>
                              </div>
                            </div>
                      </div>

                      <div class="form-group">
                      <label class="col-md-3 control-label">Serial <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input  type="text" name="serial" id="serial" class="form-control"  required>
                      </div>
                      </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Purchase Date <span class="required">*</span></label>
                              <div class='col-md-7 col-sm-6 col-xs-12'>
                            <input type='text' name="purchase_date" id="purchase_date" class="form-control input-group date myDatepicker2" required />
                      </div>
                         </div>
                                   
                      <div class="form-group">
                      <label class="col-md-3 control-label">Supplier <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input  type="text" name="supplier" id="supplier" class="form-control"  required>
                      </div>
                      </div>

                      <div class="form-group">
                      <label class="col-md-3 control-label">Order Number <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input  type="text" name="order_number" id="order_number" class="form-control"  required>
                      </div>
                      </div>


                      <div class="form-group">
                      <label class="col-md-3 control-label">Purchase Cost <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input  type="text" name="purchase_cost" id="purchase_cost" class="form-control"  required>
                      </div>
                      </div>


                      <div class="form-group">
                      <label class="col-md-3 control-label">Warranty <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <input  type="text" id="warranty" name="warranty" class="form-control" placeholder="In Months"  required>
                      </div>
                      </div>


                      <div class="form-group">
                      <label class="col-md-3 control-label">Notes <span class="required">*</span></label>
                        <div class="col-md-7 col-sm-6 col-xs-12">
                        <textarea id="notes" name="notes" class="form-control" required=""></textarea>
                      </div>
                      </div>

                          <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Default Location</label>
                              <div class="col-md-7">
                                <select class="form-control" name="location" id="location" >
                                <option value="">--Select Location--</option>
                                  @if(isset($location))
                                    <?php
                                        for ($i=0; $i <count($location) ; $i++) { 
                                          echo "<option value=\"".$location[$i]['location_id']."\">".$location[$i]['location_name']."</option>";
                                        }
                                    ?>
                                  @endif
                                </select>
                              </div>
                            </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#editAsset">Cancel</button>
                          <button id="send" type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div> 
                   </form>
                   </fieldset>
                   </div>
                    <br><br>
                    <fieldset>
                  <legend>Show Assets</legend>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                         <th hidden>asset</th>
                          <th>Asset Name</th>
                          <th>Model</th> 
                          <th>Category</th>
                          <th>Status</th>
                          <th>Employee</th>
                          <th hidden="">Serial</th>
                          <th >Purchase Date</th>
                          <th hidden="">Supplier</th>
                          <th hidden="">Order Number</th>
                          <th hidden="">Purchase Cost</th>
                          <th>Warranty</th>
                          <th>Notes</th>
                          <th>Location</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        @if(isset($assets))
                         <?php
                            for($i=0;$i<count($assets);$i++){
                            echo "<tr>";
                            echo "<td hidden>".$assets[$i]['asset_id']."</td>";
                            echo "<td>".$assets[$i]['asset_name']."</td>";
                            echo "<td>".$assets[$i]['mname'].'/'.$assets[$i]['model_number']."</td>";
                            echo "<td>".$assets[$i]['category']."</td>";
                            echo "<td>".$assets[$i]['status']."</td>";
                            echo "<td>".$assets[$i]['full_name']."</td>";
                            echo "<td hidden>".$assets[$i]['serial']."</td>";
                            echo "<td >".$assets[$i]['purchase_date']."</td>";
                            echo "<td hidden>".$assets[$i]['supplier']."</td>";
                            echo "<td hidden>".$assets[$i]['order_number']."</td>";
                            echo "<td hidden>".$assets[$i]['purchase_cost']."</td>";
                            echo "<td>".$assets[$i]['warranty']."</td>";
                            echo "<td>".$assets[$i]['notes']."</td>";
                            echo "<td>".$assets[$i]['lname']."</td>";
                            echo "<td><a  style=\"height:25px; padding-top:0%;\" class=\"btn btn-primary edit\" data-toggle=\"collapse\" data-target=\"#editAsset\"><i class=\"fa fa-edit\"></i> <span>Edit</span></a></td>";
                            echo "</tr>";
                          }
                          ?>
                        @endif
                      </tbody>
                    </table>    
                  </fieldset>
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

    $('.edit').click(function(){
        $('#asset').val($(this).parent().siblings('td').eq(0).text());
        $('#asset_name').val($(this).parent().siblings('td').eq(1).text());
        $("#model option:contains(" + $(this).parent().siblings('td').eq(2).text() + ")").attr('selected', 'selected');
        $("#category option:contains(" + $(this).parent().siblings('td').eq(3).text() + ")").attr('selected', 'selected');
        $("#status option:contains(" + $(this).parent().siblings('td').eq(4).text() + ")").attr('selected', 'selected');
        $('#serial').val($(this).parent().siblings('td').eq(6).text());
        $('#purchase_date').val($(this).parent().siblings('td').eq(7).text());
        $('#supplier').val($(this).parent().siblings('td').eq(8).text());
        $('#order_number').val($(this).parent().siblings('td').eq(9).text());
        $('#purchase_cost').val($(this).parent().siblings('td').eq(10).text());
        $('#warranty').val($(this).parent().siblings('td').eq(11).text());
        $('#notes').val($(this).parent().siblings('td').eq(12).text());
        $("#location option:contains(" + $(this).parent().siblings('td').eq(13).text() + ")").attr('selected', 'selected');
        
        if($(this).parent().siblings('td').eq(5).text().length!=0){
          $('#assign').show();
          $('#msg').hide();
          $("#employee option:contains(" + $(this).parent().siblings('td').eq(5).text() + ")").attr('selected', 'selected');
        }
        else{
          $('#msg').show();
          $('#assign').hide();      
        }
         $('html, body').animate({
              scrollTop: $("#show").offset().top
          }, 2000);
    });
     $('select[name="status"]').on('change', function() {
            if($(this).val()=="Ready To Deploy"){
              $('#assign').show();
             $('#employee').empty();
             $('#employee').append("<option>--Select Employee--</option>");
                  $.ajax({
                      url: '/getSysAdminEmployee/ajax/',
                      type: "GET",
                      dataType: "json",
                      success:function(data) {
                        for(var i=0;i<data.length;i++){
                            $('#employee').append("<option value=\""+data[i]['emp_id']+"\">"+data[i]['full_name']+"</option>");
                        }
                      
                }
            });
          }
          else{
             $('#assign').hide();
           }
        });
  </script>


   @endsection     