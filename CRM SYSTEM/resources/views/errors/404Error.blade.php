<!---Author:Amol Tribhuwan********************************-->
@extends('layout.header')
	@section('import')

		<style>
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #337AB7;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 20px;
  padding: 5px;
  width: 70%;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
	@endsection

	@section('body')
		<body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <!-- page content -->
        <div class="col-md-12">
          <div class="col-middle">
            <div class="text-center text-center">
              <h1 class="error-number">404</h1>
              <h2>Access denied</h2>
              <p>Full authentication is required to access this resource. <a href="#">Report this?</a>
              </p>
              <div class="mid_center">
                <form action="{{action('UserLoginController@logout')}}" method="get">
			<div align="center">
     				<button class="button" style="vertical-align:middle;border-radius:16px;"><span>Click Here to Login </span></button>
     			</div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
      </div>
    </div>

  </body>
	@endsection