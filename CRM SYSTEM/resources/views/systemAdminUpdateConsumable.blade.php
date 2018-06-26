<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
@section('pageContent')
   <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Edit Consumable</h2>
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
                  <legend>Edit Consumable</legend>
               <form method="post" action="{{action('SysAdminOperation@updateConsumable',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" id="consumable" name="consumable">

                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Consumable Name</label>
                              <div class="col-md-7">
                                  <input type="text" id="consumable_name" name="consumable_name" class="form-control" required>
                              </div>
                            </div>

                          <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Category</label>
                              <div class="col-md-7">
                              <select class="form-control" name="category" id="category" required="">
                                <option value="">--Select Category--</option>
                                 <option value="Printer Ink">Printer Ink</option>
                                 <option value="Printer Paper">Printer Paper</option>
                                </select>
                              </div>
                            </div>

                             <div class="form-group" hidden="">
                              <label class="control-label col-md-3"  for="first-name">Manufacture</label>
                              <div class="col-md-7">
                                <select class="form-control" name="manufacture" id="manufacture" >
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
                          

                              <div class="form-group" hidden="">
                              <label class="control-label col-md-3" name="name" for="first-name">Location</label>
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



                            <div class="form-group" hidden="">
                              <label class="control-label col-md-3" name="name" for="first-name">Model Number</label>
                              <div class="col-md-7">
                                  <input type="text" id="model_number" name="model_number" class="form-control" >
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Item Number</label>
                              <div class="col-md-7">
                                  <input type="text" id="item_number" name="item_number" class="form-control" required>
                              </div>
                            </div>


                          


                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Order Number</label>
                              <div class="col-md-7">
                                  <input type="text" id="order_number" name="order_number" class="form-control" required>
                              </div>
                            </div>



                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Purchase Date</label>
                              <div class="col-md-7">
                                    <input type='text' id="purchase_date" name="purchase_date" class="form-control input-group date myDatepicker2" required />
                              </div>
                            </div>


                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Purchase Cost</label>
                              <div class="col-md-7">
                                  <input type="text" id="purchase_cost" name="purchase_cost" class="form-control" required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Quantity</label>
                              <div class="col-md-7">
                                  <input type="text" id="quantity" name="quantity" class="form-control" required>
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

                <legend>Consumable</legend>
                <fieldset>
                <legend>Show Consumable</legend>
      
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                         <th hidden>consumable</th>
                          <th>Consumable Name</th>
                          <th>Category</th>
                         
                          <th hidden="">Model Number</th>
                          <th hidden="">Item Number</th>
                          <th>Order Number</th>
                          <th>Purchase Date</th>
                          <th>Purchase Cost</th>
                           <th>Quantity</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($consumable))
                          <?php
                            for ($i=0; $i <count($consumable) ; $i++) { 
                              echo "<td hidden>".$consumable[$i]['consumable_id']."</td>";
                              echo "<td>".$consumable[$i]['consumable_name']."</td>";
                             
                              echo "<td>".$consumable[$i]['category']."</td>";
                              echo "<td hidden>".$consumable[$i]['model_number']."</td>";
                              echo "<td hidden>".$consumable[$i]['item_number']."</td>";
                              echo "<td>".$consumable[$i]['order_number']."</td>";
                              echo "<td>".$consumable[$i]['purchase_date']."</td>";
                              echo "<td>".$consumable[$i]['purchase_cost']."</td>";
                              echo "<td>".$consumable[$i]['quantity']."</td>";
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
          $('#consumable').val($(this).parent().siblings('td').eq(0).text());
          $('#consumable_name').val($(this).parent().siblings('td').eq(1).text());
          $("#category option:contains(" + $(this).parent().siblings('td').eq(2).text() + ")").attr('selected', 'selected');
          //$("#location option:contains(" + $(this).parent().siblings('td').eq(8).text() + ")").attr('selected', 'selected');
          $('#item_number').val($(this).parent().siblings('td').eq(4).text());
          $('#order_number').val($(this).parent().siblings('td').eq(5).text());
          $('#purchase_date').val($(this).parent().siblings('td').eq(6).text());
          $('#purchase_cost').val($(this).parent().siblings('td').eq(7).text());
          $('#quantity').val($(this).parent().siblings('td').eq(8).text());
          // $('#edit').modal('show');
      
         $('html, body').animate({
              scrollTop: $("#show").offset().top
          }, 2000);
        });  
        </script>
@endsection