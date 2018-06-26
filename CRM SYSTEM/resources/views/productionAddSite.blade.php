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
                  <div id="addSite" class="collapse">
                  
                   <form id="myForm" class="form-horizontal form-label-left input_mask" method="post" action="{{action('ProductionMasterOperation@addSite',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    
                    <fieldset>
                      <legend>Add Sites</legend>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Site Name<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="site_name" id="item_name"  class="form-control">
                            <input type="hidden" name="item_id" id="item_id" class="form-control">
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
                  <div id="editSite" class="collapse">
                  <form class="form-horizontal form-label-left input_mask" method="post" action="{{action('ProductionMasterOperation@updateSite',csrf_token())}}" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    
                    <fieldset>
                      <legend>Edit Sites</legend>
                      <div class="form-group ">
                          <label class="col-md-3 control-label">Site Id<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="site_id" id="site_id" class="form-control" readonly="">
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Site Name<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" name="site_name" id="site_name"  class="form-control">
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

          
                  <a data-toggle="collapse" class="item btn btn-info btn-xs" data-target="#addSite">Add Site</a>
                   <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Actions</th>
                          <th hidden>Site ID</th>
                          <th>Site name</th>
                        </tr>
                      </thead>

                      <tbody>
                    @if(isset($sites))
                      @foreach($sites as $key => $value)
                        <tr>
                          <td>
                            <a data-toggle="collapse" class="edit btn btn-info btn-xs"  data-target="#editSite">Edit</a>
                           </td>
                          <td hidden>{{$value['site_id']}}</td>
                          <td>{{$value['site_name']}}</td>
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

        $('.edit').click(function(){
            $('#site_id').val($(this).parents().siblings('td').eq(0).text()); 
            $('#site_name').val($(this).parents().siblings('td').eq(1).text());
           

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
