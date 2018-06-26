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
                  <div id="addWarehouse" class="collapse">
                  
                   <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('ProductionMasterOperation@updateWarehouse',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    
                    <fieldset>
                      <legend>Add WareHouse</legend>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Warehouse Name<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="warehouse_name"  class="form-control">
                            <input type="hidden" name="item_id" id="item_id" class="form-control">
                          </div>
                      </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">Site<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <select name="site_name" class="form-control site_name" required>
                                <option>--Select Site--</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group ">
                          <label class="col-md-3 control-label">Incharge<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="incharge"  class="form-control">
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
                  <div id="editWarehouse" class="collapse">
                  <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('ProductionMasterOperation@updateWarehouse',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    
                    <fieldset>
                      <legend>Edit WareHouse</legend>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">warehouse ID<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="warehouse_id" id="warehouse_id" class="form-control" readonly="">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-3 control-label">Site<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                                <select id="site_name" name="site_name" class="form-control site_name" required>
                                <option>--Select Site--</option>
                                </select>
                            </div>
                        </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">warehouse Name<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="warehouse_name" id="warehouse_name"  class="form-control">
                          </div>
                      </div>

                        <div class="form-group ">
                          <label class="col-md-3 control-label">Incharge<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="incharge" id="incharge" class="form-control">
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

          
                  <a data-toggle="collapse" class="warehouse btn btn-info btn-xs" data-target="#addWarehouse">Add Warehouse</a>
                   <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Actions</th>
                          <th hidden>WareHouse ID</th>
                          <th>Site Id</th>
                          <th>WareHouse name</th>
                          <th>Incharge</th>
                        </tr>
                      </thead>
                   
                      <tbody>
                      @if(isset($warehouse))
                      @foreach($warehouse as $key => $value)
                        <tr>
                          <td>
                            <a data-toggle="collapse" class="warehouse btn btn-info "  data-target="#editWarehouse">Edit</a>
                          </td>
                          <td hidden>{{$value['warehouse_id']}}</td>
                          <td>{{$value['site_name']}}</td>
                          <td>{{$value['warehouse_name']}}</td>
                          <td>{{$value['incharge']}}</td>
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
              $('.warehouse').click(function(){
                   $.ajax({
                      url:'/site/ajax',
                      type:"GET",
                      dataType:"json",
                      success:function(data){
                        $('.site_name').empty();
                        $.each(data, function(key, value) {
                            $('.site_name').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                      }
                  });

            $('#warehouse_id').val($(this).parents().siblings('td').eq(0).text()); 
            $('#warehouse_name').val($(this).parents().siblings('td').eq(2).text());
            $("#site_name option:contains("+$(this).parents().siblings('td').eq(1).text()+")").attr('selected','selected');
            $('#incharge').val($(this).parents().siblings('td').eq(3).text());
            $('html, body').animate({
              scrollTop: $("#show").offset().top
          }, 2000);
             $('html, body').animate({
              scrollTop: $("#show1").offset().top
          }, 2000);
              });
          });

        $('.warehouse').click(function(){
     
        });
     
        </script>  
    <script type="text/javascript">
        
        $(document).ready(function() {
           $("html, body").animate({ scrollTop: 0 }, "slow");
        });
    </script> 

  <!--*****************************************Wizard End***************************************************/-->
  
   @endsection     
