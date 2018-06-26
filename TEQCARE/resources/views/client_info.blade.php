@extends('master.loginMaster')
@section('content')
<div id="login-page" style="padding-top: 8%;padding-right: 3%">
       <form class="form-login" action="{{ action('UserLoginController@add_client_info') }}" class="login" method="post"> 
             <h2 class="form-login-heading">Add Your Info</h2>
            {{csrf_field()}}  
                   @if(Session::has('succMsg'))
                  <div class="alert alert-success alert-dismissible fade in col-md-12" role="alert" id="succMsg">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>
                        {{Session::get('succMsg') }}                                  
                    </strong>
                  </div>
                  @endif
                  @if(Session::has('errorMsg'))
                  <div class="alert alert-danger alert-dismissible fade in col-md-12" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong>
                    {{ Session::get('errorMsg')}}
                    </strong>
                  </div>
                  @endif
                  <div class="login-wrap" >

                   <select class="form-control" name="organisationType" id="organisationType" autofocus required>
                              <option>--Select Organization Type--</option>
                              <option value="Individual">Individual</option>
                              <option value="Partnership">Partnership</option>
                              <option value="Pvt Lmt Company">Pvt Lmt Company</option>
                              <option value="Institution">Institution</option>
                              <option value="School">School</option>
                              <option value="Other">Other</option>  
                    </select>
                    <br>
                <input type="text" id="divOn" name="organisationName" class="form-control" placeholder="Organization Name" >
                <br>
                <input type="text" name="contactPerName" class="form-control" placeholder="Contact Person Name" required>
                <br>
                <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-add"></i> Add Info</button>
                <hr>
              </div>
            </form>
            </div>
    </script>
 @endsection