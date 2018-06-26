<!---Author:Amol Tribhuwan********************************-->
  @extends('master.master')
  @section('import')
    <!-- Include SmartWizard CSS -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />
    
    <!-- Optional SmartWizard theme -->
    <link href="{{asset('assets/smart_wizard/dist/css/smart_wizard_theme_dots.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('assets/css/chosen.min.css')}}">
    @endsection
  @section('pageContent')
<div class="right_col" role="main">
                      <div class="row">
                       <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="x_panel">
                           <div class="x_title">
                             <h2>Quotation</h2>
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
               <div id="show" >
                <fieldset id="send" class="collapse">
                  <legend>Resend Quotation</legend>
                <fieldset>
                <legend>Download Quotation</legend>
                    <a href="/downloadQuotation"> Click to Download Quotaion </a> 
                </fieldset><br>
                
                <fieldset >
                <legend>Send Email</legend>
                  <form class="form-horizontal form-label-left input_mask" method="post" action="{{action('Sales@sendQuotation')}}" enctype="multipart/form-data" role="form" data-toggle="validator" accept-charset="utf-8">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                     <input type="hidden" name="quotation" id="quotation">
                      <div class="form-group ">
                        <label class="col-md-3 control-label">TO</label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" id="toEmail" name="toEmail" class="form-control lead_id" required>
                          </div>
                      </div>

                      <div class="form-group ">
                          <label class="col-md-3 control-label">Subject<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                            <input type="text" id="subject" name="subject" id="subject" class="form-control" required>
                          </div>
                        </div>
                        
                        <div class="form-group">
                        <label class="col-md-3 control-label">Choose File<span class="required">*</span></label>
                       <div class="btn-group col-md-7">
                        <input type="file" name="file" accept=".pdf" required/>
                      </div>
                      </div>

                      <!--div class="form-group ">
                          <label class="col-md-3 control-label">Message<span class="required">*</span></label>
                          <div class="col-md-7 col-sm-6 col-xs-12">
                              <textarea class="editor-wrapper form-control" name="message" id="editor-one" required></textarea>
                         </div>
                        </div-->
                      
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <a id="cancel" class="btn btn-primary change" data-toggle="collapse" data-target="#show">Cancel</a>
                          <button type="submit" class="btn btn-success">Send</button>
                        </div>
                      </div>
                </form>
              </fieldset> 
              </fieldset>
                </div>
                <br>
                <br>
                   <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th hidden>Quotation</th>
                          <th>Contact Person Name</th>
                          <th>Email</th>
                          <th>Address</th>
                          <th>Mobile Number </th>
                          <th>Phone Number</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($quotation))
                        <?php
                            for ($i=0; $i <count($quotation) ; $i++) { 
                                echo "<tr>";
                                echo "<td hidden>".$quotation[$i]['quotation_id']."</td>";
                                echo "<td >".$quotation[$i]['contact_person_name']."</td>";
                                echo "<td >".$quotation[$i]['email']."</td>";
                                echo "<td >".$quotation[$i]['address']."</td>";
                                echo "<td >".$quotation[$i]['mobile_no']."</td>";
                                echo "<td >".$quotation[$i]['phone_no']."</td>";
                                if($quotation[$i]['sendStatus']==0){
                                  echo "<td><button type=\"button\" data-toggle=\"collapse\" data-target=\"#send\" class=\"btn btn-danger btn-xs sendQuotation\">
                                      <span class=\"fa fa-remove-sign\"></span> Unsend
                                  </button></td>";
                                }
                                else{
                                    echo "<td><button type=\"button\" class=\"btn btn-success btn-xs\">
                                      <span class=\"fa fa-ok-sign\"></span> Send
                                  </button> </td>";
                                  echo "</tr>";
                                }

                              }  
                        ?>
                       @endif
                          </tbody>
                    </table>
                  </div> 
            
                  </div>
                </div>
          </div>
        </div>
        

  <script type="text/javascript">

        $('.sendQuotation').click(function(){
              $('#quotation').val($(this).parents().siblings('td').eq(0).text());
              $('#toEmail').val($(this).parents().siblings('td').eq(2).text());
              $('#subject').val("Quotation-"+$(this).parents().siblings('td').eq(0).text());
              $.ajax({
                      url: '/setQuotationSession/ajax/',
                      data:{quotation:$(this).parents().siblings('td').eq(0).text()},
                      type: "GET",
                      dataType: "text",
                      success:function(data) {
                     
                          }
                       });
            $('html, body').animate({
              scrollTop: $("#show").offset().top
          }, 2000);
        });
  </script>
   @endsection     