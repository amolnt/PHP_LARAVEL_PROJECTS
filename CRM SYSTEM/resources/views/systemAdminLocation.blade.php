<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
@section('pageContent')
   <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add/Edit Location</h2>
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
                <fieldset>
                  <legend>Add New  Location</legend>
                  <a style="height:30px; padding-top:0%;" class="btn btn-primary addDistrict" data-toggle="collapse" data-target="#add"><i class="fa fa-plus"></i> <span>Add new</span></a>


            <form method="post" action="{{action('SysAdminOperation@addLocation',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div id="add" class="collapse">
                <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">

                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Location Name</label>
                              <div class="col-md-7">
                                  <input type="text" id="addLocation_name" name="addLocation_name" class="form-control" required>
                              </div>
                            </div>

                          <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">City</label>
                              <div class="col-md-7">
                              <select class="form-control" name="addCity" id="addCity" required="">
                                <option value="">--Select City--</option>
                                  @if(isset($city))
                                    <?php
                                        for ($i=0; $i <count($city) ; $i++) { 
                                          echo "<option value=\"".$city[$i]['city_id']."\">".$city[$i]['city_name']."</option>";
                                        }
                                    ?>
                                  @endif
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Country</label>
                              <div class="col-md-7">
                              <select class="form-control" name="addCountry" id="addCountry" required="">
                                <option value="">--Select Country--</option>
                                  @if(isset($country))
                                    <?php
                                        for ($i=0; $i <count($country) ; $i++) { 
                                          echo "<option value=\"".$country[$i]['country_id']."\">".$country[$i]['country_name']."</option>";
                                        }
                                    ?>
                                  @endif
                                </select>
                              </div>
                            </div>

                          <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" type="reset">Reset</button>
                            <input type="submit" class="btn btn-success" value="submit">
                          </div>
                        </div>  
                       </form>
                </fieldset>
                <br>
                <div id="show">
                  <fieldset id="edit" class="collapse">
                  <legend>Edit Location</legend>
             
            <form method="post" action="{{action('SysAdminOperation@updateLocation',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
          
                          <input type="hidden" name="location">
                            <div class="form-group">
                              <label class="control-label col-md-3" name="name" for="first-name">Location Name</label>
                              <div class="col-md-7">
                                  <input type="text" id="editLocation_name" name="editLocation_name" class="form-control" required>
                              </div>
                            </div>

                          <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">City</label>
                              <div class="col-md-7">
                              <select class="form-control" name="editCity" id="editCity">
                                <option>--Select City--</option>
                                  @if(isset($city))
                                    <?php
                                        for ($i=0; $i <count($city) ; $i++) { 
                                          echo "<option value=\"".$city[$i]['city_id']."\">".$city[$i]['city_name']."</option>";
                                        }
                                    ?>
                                  @endif
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Country</label>
                              <div class="col-md-7">
                              <select class="form-control" name="editCountry" id="editCountry">
                                <option>--Select Country--</option>
                                  @if(isset($country))
                                    <?php
                                        for ($i=0; $i <count($country) ; $i++) { 
                                          echo "<option value=\"".$country[$i]['country_id']."\">".$country[$i]['country_name']."</option>";
                                        }
                                    ?>
                                  @endif
                                </select>
                              </div>
                            </div>

                          <div class="ln_solid"></div>
                         <div class="form-group">
                          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#edit">Cancel</button>
                            <input type="submit" class="btn btn-success" value="submit">
                          </div>
                        </div>  
                       </form>
                  </fieldset>
                  </div>
                  <br>

                <legend>Location</legend>
                <fieldset>
                <legend>Show Location</legend>
      
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                         <th hidden>location</th>
                          <th>location Name</th>
                          <th>City</th>
                          <th>Country</th>  
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        @if(isset($location))
                          <?php
                            for ($i=0; $i <count($location) ; $i++) { 
                              echo "<td hidden>".$location[$i]['location_id']."</td>";
                              echo "<td>".$location[$i]['location_name']."</td>";
                              echo "<td>".$location[$i]['city_name']."</td>";
                              echo "<td>".$location[$i]['cntry_name']."</td>";
                              echo "<td><a  class=\"btn btn-primary btn-xs editLocation\" data-toggle=\"collapse\" data-target=\"#edit\"><i class=\"fa fa-edit\" ></i> <span>Edit</span></a></td>
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
        $('.editLocation').click(function(){
          $('#location').val($(this).parent().siblings('td').eq(0).text());
          $('#editLocation_name').val($(this).parent().siblings('td').eq(1).text());
          $("#editCity option:contains(" + $(this).parent().siblings('td').eq(2).text() + ")").attr('selected', 'selected');
          $("#editCountry option:contains(" + $(this).parent().siblings('td').eq(3).text() + ")").attr('selected', 'selected');
          // $('#edit').modal('show');
      
         $('html, body').animate({
              scrollTop: $("#show").offset().top
          }, 2000);
        });  
        </script>
@endsection