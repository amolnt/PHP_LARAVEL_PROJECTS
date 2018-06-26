<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
@section('pageContent')
   <div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add/Edit Post</h2>
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
                  <legend>Add New  Post</legend>
                  <a style="height:30px; padding-top:0%;" class="btn btn-primary addDistrict" data-toggle="collapse" data-target="#add"><i class="fa fa-plus"></i> <span>Add new</span></a>


            <form method="post" action="{{action('AdminAddOperationController@addPost',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div id="add" class="collapse">
                <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Role</label>
                              <div class="col-md-7">
                              <select class="form-control" name="addRole" id="addRole">
                                <option>--Select Role--</option>
                                  @if(isset($role))
                                    <?php
                                        for ($i=1; $i <count($role) ; $i++) { 
                                          echo "<option value=\"".$role[$i]['role_id']."\">".$role[$i]['role_name']."</option>";
                                        }
                                    ?>
                                  @endif
                                </select>
                              </div>
                            </div>
                          
                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Work Charge</label>
                              <div class="col-md-7">
                              <select class="form-control" name="addWorkCharge" id="addWorkCharge">
                                <option>--Select Work Charge--</option>
                                  @if(isset($workCharge))
                                    <?php
                                        for ($i=1; $i <count($workCharge) ; $i++) { 
                                          echo "<option value=\"".$workCharge[$i]['charge_id']."\">".$workCharge[$i]['charge_name']."</option>";
                                        }
                                    ?>
                                  @endif
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="discription" for="first-name">Post Name</label>
                              <div class="col-md-7">
                                  <input type="text" id="addPost_name" name="addPost_name" class="form-control" required>
                              </div>
                            </div>

                              <div class="form-group">
                              <label class="control-label col-md-3" name="discription" for="first-name">Superior</label>
                              <div class="col-md-7">
                                  <input type="text" id="addSuperior" name="addSuperior" class="form-control" required>
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
                  <legend>Edit Post</legend>
                <form method="post" action="{{action('AdminEditOperationController@updatePost',csrf_token())}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="col-md-12">
                      <div class="x_panel">
                        <div class="x_content">
                          <input type="hidden" id="post" name="post">
                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Role</label>
                              <div class="col-md-7">
                              <select class="form-control" name="editRole" id="editRole">
                                <option>--Select Role--</option>
                                @if(isset($role))
                                    <?php
                                        for ($i=1; $i <count($role) ; $i++) { 
                                          echo "<option value=\"".$role[$i]['role_id']."\">".$role[$i]['role_name']."</option>";
                                        }
                                    ?>
                                  @endif
                                </select>
                              </div>
                            </div>
                          
                            <div class="form-group">
                              <label class="control-label col-md-3"  for="first-name">Work Charge</label>
                              <div class="col-md-7">
                              <select class="form-control" name="editWorkCharge" id="editWorkCharge">
                                <option>--Select Work Charge--</option>
                                  @if(isset($workCharge))
                                    <?php
                                        for ($i=1; $i <count($workCharge) ; $i++) { 
                                          echo "<option value=\"".$workCharge[$i]['charge_id']."\">".$workCharge[$i]['charge_name']."</option>";
                                        }
                                    ?>
                                  @endif
                                </select>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="discription" for="first-name">Post Name</label>
                              <div class="col-md-7">
                                  <input type="text" id="editPost_name" name="editPost_name" class="form-control" required>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3" name="Superior" for="superior">Superior</label>
                              <div class="col-md-7">
                                  <input type="text" id="editSuperior" name="editSuperior" class="form-control">
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

                <legend>Post</legend>
                <fieldset>
                <legend>Show Post</legend>
        <form method="post"  enctype="multipart/form-data" class="form-horizontal form-label-left">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                         <th hidden>post</th>
                          <th>Role Name</th>
                          <th>charge Name</th>
                          <th>Post Name</th> 
                          <th>Superior</th> 
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        @if(isset($post))
                          <?php
                            for ($i=1; $i <count($post) ; $i++) { 
                              echo "<td hidden>".$post[$i]['post_id']."</td>";
                              echo "<td>".$post[$i]['role_name']."</td>";
                              echo "<td>".$post[$i]['charge_name']."</td>";
                              echo "<td>".$post[$i]['post_name']."</td>";
                              echo "<td>".$post[$i]['superior']."</td>";
                              echo "<td><a  class=\"btn btn-primary btn-xs editPost\" data-toggle=\"collapse\" data-target=\"#edit\"><i class=\"fa fa-edit\" ></i> <span>Edit</span></a></td>
                            </tr>";
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

        <script type="text/javascript">
        $('select[name="addWorkCharge"]').on('change', function() {
            $('#addPost_name').val( $("#addRole option[value='"+$('#addRole').val()+"']").text()+"-"+$("#addWorkCharge option[value='"+$('#addWorkCharge').val()+"']").text());
        });

        $('select[name="addRole"]').on('change', function() {
            $('#addPost_name').val( $("#addRole option[value='"+$('#addRole').val()+"']").text()+"-"+$("#addWorkCharge option[value='"+$('#addWorkCharge').val()+"']").text());
        });


        $('select[name="editRole"]').on('change', function() {
            $('#editPost_name').val( $("#editRole option[value='"+$('#editRole').val()+"']").text()+"-"+$("#editWorkCharge option[value='"+$('#editWorkCharge').val()+"']").text());
        });

        $('select[name="editWorkCharge"]').on('change', function() {
            $('#editPost_name').val( $("#editRole option[value='"+$('#editRole').val()+"']").text()+"-"+$("#editWorkCharge option[value='"+$('#editWorkCharge').val()+"']").text());
        });

        $('.editPost').click(function(){
          $('#post').val($(this).parent().siblings('td').eq(0).text());
          $("#editRole option:contains(" + $(this).parent().siblings('td').eq(1).text() + ")").attr('selected', 'selected');
          $("#editWorkCharge option:contains(" + $(this).parent().siblings('td').eq(2).text() + ")").attr('selected', 'selected');
          $('#editPost_name').val($(this).parent().siblings('td').eq(3).text());
          $('#editSuperior').val($(this).parent().siblings('td').eq(4).text());
          // $('#edit').modal('show');
      
         $('html, body').animate({
              scrollTop: $("#show").offset().top
          }, 2000);
        });  

         $('select[name="addRole"]').on('change', function() {
            $('#addSuperior').val("");
            var roleId = $(this).val();
            if(roleId) {
                $.ajax({
                    url: '/getSuperior/ajax/'+roleId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      $('#addSuperior').val(data);
                    }
                });
            }else{
              $('#addSuperior').val("");
            }
        });

         $('select[name="editRole"]').on('change', function() {
            $('#editSuperior').val("");
            var roleId = $(this).val();
            if(roleId) {
                $.ajax({
                    url: '/getSuperior/ajax/'+roleId,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                      $('#editSuperior').val(data);
                    }
                });
            }else{
              $('#editSuperior').val("");
            }
        });
        </script>
@endsection