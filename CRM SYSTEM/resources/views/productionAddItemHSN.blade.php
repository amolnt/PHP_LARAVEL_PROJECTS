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
                  <div id="addItemHSN" class="collapse">
                  
                   <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('ProductionMasterOperation@addItemHSN',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    
                    <fieldset>
                      <legend>Add Item HSN</legend>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">HSN Code<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="item_hsn_code"  class="form-control">
                          </div>
                      </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">Item GST<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                              <input type="text" name="item_gst" value="18" class="form-control">
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="form-group ">
                          <label class="col-md-3 control-label">Item Description<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <textarea name="item_description" class="form-control" rows="4"></textarea>
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
                  <div id="editItemHSN" class="collapse">
                  <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('ProductionMasterOperation@updateItemHSN',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    
                    <fieldset>
                      <legend>Edit Item HSN</legend>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">HSN Code<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="item_hsn_code" id="item_hsn_code" class="form-control">
                            <input type="hidden" name="item_hsn_id" id="item_hsn_id">
                          </div>
                      </div>

                        <div class="form-group">
                          <label class="col-md-3 control-label">Item GST<span class="required">*</span></label>
                            <div class="col-md-7 col-sm-6 col-xs-12">
                              <input type="text" name="item_gst" id="item_gst" value="18" class="form-control">
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        <div class="form-group ">
                          <label class="col-md-3 control-label">Item Description<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <textarea name="item_description" id="item_description" class="form-control" rows="4"></textarea>
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

          
                  <a data-toggle="collapse" class="warehouse btn btn-info btn-xs" data-target="#addItemHSN">Add HSN Code</a>
                   <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Actions</th>
                          <th hidden>Item HSN ID</th>
                          <th>HSN code</th>
                          <th>GST</th>
                          <th>Item Description</th>
                        </tr>
                      </thead>
                   
                      <tbody>
                     @if(isset($itemhsn))
                     @foreach($itemhsn as $key=>$value)
                        <tr>
                          <td>
                            <a data-toggle="collapse" class="edit btn btn-info "  data-target="#editItemHSN">Edit</a>
                          </td>
                          <td hidden>{{$value['item_hsn_id']}}</td>
                          <td>{{$value['item_hsn_code']}}</td>
                          <td>{{$value['item_gst']}}</td>
                          <td>{{$value['name']}}</td>
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
              $('.edit').click(function(){
    
            $('#item_hsn_id').val($(this).parents().siblings('td').eq(0).text()); 
            $('#item_hsn_code').val($(this).parents().siblings('td').eq(1).text());
            $('#item_gst').val($(this).parents().siblings('td').eq(2).text());
            $('#item_description').val($(this).parents().siblings('td').eq(3).text());
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