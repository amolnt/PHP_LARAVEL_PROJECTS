@extends('master.master')
	@section('pageContent')
		<div class="right_col" role="main">
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Profile</h2>
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
					
    <div class="row">
        <div class="col-sm-2 col-md-2">
            <img src=""
            alt="LOGO" class="img-rounded img-responsive" />
        </div>
        <div class="col-sm-4 col-md-4">
            <blockquote>
                <p>@if(isset($contact)) {{$contact}} @endif</p> @if(isset($address) && count($address)!=0)<small><cite title="Profile">{{$address}}  <i class="fa fa-map-marker"></i></cite></small>@endif 
                
            </blockquote>
             @if(isset($email)) <i class="fa fa-envelope"></i>  {{$email}} @endif
                <br
                /> @if(isset($organization) && count($organization)!=0)<i class="fa fa-globe"></i>  {{$organization}} @endif
                
        </div>
    </div>
    <br>
    <br>
    		<!--div id="addLocation" class="collapse">
    			<fieldset>
    			<legend>Add Location</legend>
             <form class="" action="{{ action('CustomController@addProfileLocation') }}" class="login" method="post"> 
            		  	<input type="hidden" name="_token" value="{{csrf_token()}}">
                	<div class="form-group">
                        <label class="control-label col-md-3" >address Location</label>
                        <div class="col-md-7">
                          <input type="text" class="form-control" name="address" id="address" required>
                        </div>
                        </div>

                        <br>
                        <br>
		                  <div class="ln_solid"></div>
	                       <div class="form-group">
	                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							   <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addLocation">Cancel</button>
	                         <button type="submit" class="btn btn-success">Add</button>
	                        </div>
	                      </div>
            </form>
            </fieldset>    
            </div-->
                  </div>
              </div>
            </div>
          </div>
        </div>
	@endsection