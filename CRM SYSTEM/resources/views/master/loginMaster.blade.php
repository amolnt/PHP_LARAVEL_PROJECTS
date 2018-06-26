<!---Author:Amol Tribhuwan********************************-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive,">

    <title>Mahasystems</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/LoginMaster/css/bootstrap.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{asset('assets/LoginMaster/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="{{asset('assets/LoginMaster/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/LoginMaster/css/style-responsive.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script rgba(255, 255, 255, 0.8); src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-default navbar-fixed-top pull-left" style="background-color:#fff ">
      <div class="container pull-left">
        <div class="navbar-header pull-left" >
          <img src="{{asset('assets/images/logo.png')}}" width="300" alt="MAHASYSTEMS">
        </div>
        </div>
      </div>
    @yield('content')    
    
     <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{asset('assets/LoginMaster/js/jquery.js')}}"></script>
    <script src="{{asset('assets/LoginMaster/js/bootstrap.min.js')}}"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="{{asset('assets/LoginMaster/js/jquery.backstretch.min.js')}}"></script>
    <script>
        $.backstretch("{{asset('assets/LoginMaster/img/bg.jpg')}}", {speed: 900,fade: 750,maxHeight: '300px'});
    </script>

    <script type="text/javascript">
    $(document).ready(function () {
            if($('#errorMsg').text()!=null && $('#errorMsg').text()!=undefined)
            {
                $('#errorMsg').delay(3000).fadeOut('slow');
            }
            if($('#succMsg').text()!=null && $('#errorMsg').text()!=undefined)
            {
                $('#succMsg').delay(3000).fadeOut('slow');
            }
        });
    </script>
  </body>
</html>
