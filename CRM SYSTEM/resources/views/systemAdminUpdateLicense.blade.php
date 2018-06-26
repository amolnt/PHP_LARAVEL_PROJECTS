<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
@section('pageContent')
   <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit License</h2>
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
                <div id="show">
                  <fieldset id="edit" class="collapse">
                  <legend>Edit License</legend>
                 <form method="post" action="{{action('SysAdminOperation@updateLicense',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" id="license" name="license">
                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Software Name</label>
                              <div class="col-md-7">
                                  <input type="text" id="software_name" name="software_name" class="form-control" required>
                              </div>
                            </div>


                            <div class="form-group" >
                              <label class="control-label col-md-3" name="name" for="first-name">Product Key</label>
                              <div class="col-md-7">
                                <textarea name="product_key" id="product_key" class="form-control"></textarea>
                              </div>
                            </div>

                             <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Manufacture</label>
                              <div class="col-md-7">
                                <select class="form-control" name="manufacture" id="manufacture" required="">
                                <option value="">--Select Manufacture--</option>
                                  @if(isset($manufacture))
                                    <?php
                                        for ($i=0; $i <count($manufacture) ; $i++) { 
                                          echo "<option value=\"".$manufacture[$i]['manufacure_id']."\">".$manufacture[$i]['manufacure_name']."</option>";
                                        }
                                    ?>
                                  @endif
                                </select>
                              </div>
                            </div>
                          
                             <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">License To Name</label>
                              <div class="col-md-7">
                                  <input type="text" id="license_to_name" name="license_to_name" class="form-control" required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">License To Email</label>
                              <div class="col-md-7">
                                  <input type="text" id="license_to_email" name="license_to_email" class="form-control" required>
                              </div>
                            </div>

                            <div class="form-group" >
                              <label class="control-label col-md-3" name="name" for="first-name">Supplier Name</label>
                              <div class="col-md-7">
                                  <input type="text" id="supplier" name="supplier" class="form-control" required="">
                              </div>
                            </div>


                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Order Number</label>
                              <div class="col-md-7">
                                  <input type="text" id="order_number" name="order_number" class="form-control" required>
                              </div>
                            </div>


                             <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Purchase Cost</label>
                              <div class="col-md-7">
                                  <input type="text" id="purchase_cost" name="purchase_cost" class="form-control" required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Purchase Date</label>
                              <div class="col-md-7">
                                    <input type='text' id="purchase_date" name="purchase_date" class="form-control input-group date myDatepicker2" required />
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Expire Date</label>
                              <div class="col-md-7">
                                    <input type='text' id="expire_date" name="expire_date" class="form-control input-group date myDatepicker2" required />
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Termination Date</label>
                              <div class="col-md-7">
                                    <input type='text' id="termination_date" name="termination_date" class="form-control input-group date myDatepicker2" required />
                              </div>
                            </div>
                           
                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Purchase Order Number</label>
                              <div class="col-md-7">
                                  <input type="text" id="purchase_order_number" name="purchase_order_number" class="form-control" required>
                              </div>
                            </div>

                              <div class="form-group" >
                              <label class="control-label col-md-3" name="name" for="first-name">Notes</label>
                              <div class="col-md-7">
                                <textarea name="notes" id="notes" class="form-control"></textarea>
                              </div>
                            </div>

                          <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#edit">Cancel</button>
                            <input type="submit" class="btn btn-success" value="Update">
                          </div>
                        </div>  
                       </form>
                  </fieldset>
                  </div>
                  <br>

                <legend>License</legend>
                <fieldset>
                <legend>Show License</legend>
      
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                         <th hidden>license</th>
                          <th>Software Name</th>
                          <th>Product Key</th>
                          <th >Manufacture</th>
                          <th hidden="">Licendse To Name</th>
                          <th>Licendse To Email</th>
                          <th>Supplier</th>
                          <th hidden="">Order Number</th>
                           <th>Purchase Cost</th>
                           <th>Purchase date</th>
                           <th >Expiry Date</th>
                           <th hidden="">Termination Date</th>
                           <th hidden="">Purchase Order Number</th>
                           <th>Notes</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($license))
                          <?php
                            for ($i=0; $i <count($license) ; $i++) { 
                              echo "<td hidden>".$license[$i]['license_id']."</td>";
                              echo "<td>".$license[$i]['software_name']."</td>"; 
                              echo "<td>".$license[$i]['product_key']."</td>";
                              echo "<td >".$license[$i]['manufacure_name']."</td>";
                              echo "<td hidden>".$license[$i]['license_to_name']."</td>";
                              echo "<td>".$license[$i]['license_to_email']."</td>";
                              echo "<td>".$license[$i]['supplier']."</td>";
                              echo "<td hidden>".$license[$i]['order_number']."</td>";
                              echo "<td>".$license[$i]['purchase_cost']."</td>";
                              echo "<td>".$license[$i]['purchase_date']."</td>";
                              echo "<td>".$license[$i]['expiry_date']."</td>";
                              echo "<td hidden>".$license[$i]['termination_date']."</td>";
                              echo "<td hidden>".$license[$i]['purchase_order_number']."</td>";
                              echo "<td>".$license[$i]['notes']."</td>";
                              echo "<td><a  class=\"btn btn-primary btn-xs edit\" data-toggle=\"collapse\" data-target=\"#edit\"><i class=\"fa fa-edit\" ></i> <span>Edit</span></a></td>
                            </tr>";
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
        $('.edit').click(function(){
          $('#license').val($(this).parent().siblings('td').eq(0).text());
          $('#software_name').val($(this).parent().siblings('td').eq(1).text());
          $('#product_key').val($(this).parent().siblings('td').eq(2).text());
          $("#manufacture option:contains(" + $(this).parent().siblings('td').eq(3).text() + ")").attr('selected', 'selected');
          //$("#location option:contains(" + $(this).parent().siblings('td').eq(8).text() + ")").attr('selected', 'selected');
           $('#license_to_name').val($(this).parent().siblings('td').eq(4).text());
            $('#license_to_email').val($(this).parent().siblings('td').eq(5).text());
          $('#supplier').val($(this).parent().siblings('td').eq(6).text());
          $('#order_number').val($(this).parent().siblings('td').eq(7).text());
          $('#purchase_cost').val($(this).parent().siblings('td').eq(8).text());
          $('#purchase_date').val($(this).parent().siblings('td').eq(9).text());
          $('#expire_date').val($(this).parent().siblings('td').eq(10).text());
          $('#termination_date').val($(this).parent().siblings('td').eq(11).text());
          $('#purchase_order_number').val($(this).parent().siblings('td').eq(12).text());
          $('#notes').val($(this).parent().siblings('td').eq(13).text());
          
         $('html, body').animate({
              scrollTop: $("#show").offset().top
          }, 2000);
        });  
        </script>
@endsection


