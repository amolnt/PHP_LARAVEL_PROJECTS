<!---Author:Amol Tribhuwan********************************-->
@extends('master.master')
@section('import')
    <!-- Include SmartWizard CSS -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />
    
    <!-- Optional SmartWizard theme -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard_theme_dots.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('assets/css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/dropdown.css')}}">
  @endsection
  @section('pageContent')
     <div class="right_col" id="top" role="main">
            <div class="row ">
              <div class="col-md-12 col-xs-12 col-sm-12" >
                <div class="x_panel tab-content">
                  <div class="x_title">
                    <h2>Add Customer</h2>
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
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div id="show">
                  <fieldset id="edit" class="collapse">
                    <legend>Create Customer</legend>
                  <form class="form-horizontal form-label-left input_mask" method="post" action="{{action('MrkManagerOperation@editCustomer',csrf_token())}}" enctype="multipart/form-data" role="form" data-toggle="validator" id="approveForm" accept-charset="utf-8">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <input type="hidden" name="customer" id="customer">

                       <div class="form-group" >
                        <label class="control-label col-md-3" for="first-name">Account Name<span class="required">*</span></label>
                        <div class="col-md-7">
                             <input type="text" id="account_name" name="account_name" class="form-control" required>
                         </div>
                      </div>

                      <div class="form-group" >
                        <label class="control-label col-md-3" for="first-name">CIN Number<span class="required">*</span></label>
                        <div class="col-md-7">
                             <input type="text" id="CIN" name="CIN" class="form-control" required>
                         </div>
                      </div>

                      <div class="form-group" >
                        <label class="control-label col-md-3" for="first-name">GST Number<span class="required">*</span></label>
                        <div class="col-md-7">
                             <input type="text" id="GST" name="GST" class="form-control" required>
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

                <fieldset>
                <legend>Show Customers</legend>
          
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                         <th hidden>Custmer</th>
                          <th>Account Name</th>
                          <th>CIN</th>
                          <th>GST</th> 
                          <th>Created By</th> 
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                        @if(isset($customer))
                          <?php
                            for ($i=0; $i <count($customer) ; $i++) { 
                              echo "<td hidden>".$customer[$i]['customer_id']."</td>";
                              echo "<td>".$customer[$i]['account_name']."</td>";
                              echo "<td>".$customer[$i]['CIN']."</td>";
                              echo "<td>".$customer[$i]['GST']."</td>";
                              echo "<td>".$customer[$i]['full_name']."</td>";
                              echo "<td><a  class=\"btn btn-primary btn-xs editCustomer\" data-toggle=\"collapse\" data-target=\"#edit\"><i class=\"fa fa-edit\" ></i> <span>Edit</span></a></td>
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




 <!-- ****************************Add Customer********************************************-->
<script type="text/javascript">

  $(document).ready(function(){
      $('.editCustomer').click(function(event){
                $('#customer').val($(this).parents().siblings('td').eq(0).text());
                $('#account_name').val($(this).parents().siblings('td').eq(1).text());
                $('#CIN').val($(this).parents().siblings('td').eq(2).text());
                $('#GST').val($(this).parents().siblings('td').eq(3).text());
                $('html, body').animate({
                  scrollTop: $("#show").offset().top
                }, 2000);
                //$('#approve').val($(this).parents().siblings('td').eq(3).text());
                //$('#approveForm').submit();
            });

});
</script>
  @endsection

  