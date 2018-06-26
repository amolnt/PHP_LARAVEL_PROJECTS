@extends('master.master')
	@section('pageContent')
	   <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manage Inventory</h2>
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
                  <legend>Edit Device</legend>
                       <form method="post" action="{{action('CustomController@updateEquipment')}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" id="equipment" name="equipment">
                    <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Area of Equipment<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                          <select id="area" name="area" class="form-control" required>
                          @if(isset($area))
                            <?php
                                echo "<option>--Select Area--</option>";
                                for ($i=0; $i <count($area) ; $i++) { 
                                  echo "<option value=\"".$area[$i]['a_id']."\">".$area[$i]['area_name']."</option>";
                                }
                                ?>
                          @endif
                          </select>
                         </div>
                      </div>
                     <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Product Type<span class="required">*</span>
                        </label>
                        <div class="col-md-7">
                          <select id="equ_type" name="equ_type" class="form-control" required>
                              <option value="">--Select Product Type--</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Tab">Tab</option>
                                <option value="Desktop">Desktop</option>
                                <option value="Printer">Printer</option>
                                <option value="Scanner">Scanner</option>
                                <option value="Software">Software</option>
                                <option value="Network_Device">Network Devices</option>
                                <option value="Other">Other</option>
                              </select>
                         </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Make Name</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control" name="equ_name" id="equ_name" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3">Model No</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control" name="model_no" id="model_no" required="">
                         
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 ">Serial Number</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control" name="serial_no" id="serial_no" required="">
                        </div>
                      </div>                      
                      <div class="form-group">
                        <label class="control-label col-md-3" for="first-name">Technical Specification<span class="required">*</span></label>
                        <div class="col-md-7">
                          <textarea rows="5" id="equ-discription" name="equ_discription" class="form-control col-md-7 col-xs-12" required=""></textarea>
                        </div>
                      </div>
                      <br>                    
                      <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#edit">Cancel</button>
                            <button type="submit" class="btn btn-success">Update</button>
                          </div>
                        </div>             
                  
                  </form>
                  </fieldset>
                  </div>
                  <br>

                   <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th hidden></th>
                          <th>Location</th>
                          <th>Service Tag</th>
                          <th>Model, Make &amp; Serial No.</th>
                          <th>Technical Specification</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        
                        @if(isset($tr))
                          <?php
                            echo $tr;
                          ?>
                        @endif
                        
                        <!--tr>
                          <td>Location - 1</td>
                          <td>SR-25643</td>
                          <td></td>
                          <td></td>
                          <td>Working</td>
                          <td>
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a><br>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Scrape </a>
                          </td>

                        </tr>     
                        <tr>
                          <td>Location - 2</td>
                          <td>SR-25644</td>
                          <td></td>
                          <td></td>
                          <td>Under Repair</td>
                          <td>
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a><br>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Scrape </a>
                          </td>
                        </tr>
                        <tr>
                          <td>Location - 3</td>
                          <td>SR-25645</td>
                          <td></td>
                          <td></td>
                          <td>Non-Working</td>
                          <td>
                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a><br>
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Scrape </a>
                          </td>
                        </tr-->
                      </tbody>
                    </table>
                          
                  </div>
              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          $('.edit').click(function(){
             $('#equipment').val($(this).parent().siblings('td').eq(0).text());

             $.ajax({
                    url: '/getEquipment/ajax/'+$(this).parent().siblings('td').eq(0).text(),
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      $('#area').val(data['a_id']);
                       $("#equ_type option:contains(" + data['equ_type'] + ")").attr('selected', 'selected');
                      $('#equ_name').val(data['equ_name']);
                      $('#model_no').val(data['model_no']);
                      $('#serial_no').val(data['serial_no']);
                      $('#equ-discription').val(data['equ_discription']);
                    }
                });

            $('#consumable').val();
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