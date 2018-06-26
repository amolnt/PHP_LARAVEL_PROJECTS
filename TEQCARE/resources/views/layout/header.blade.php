<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TEQ CARE! | </title>

    <!-- Bootstrap -->
    <link href= "{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('assets/css/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('assets/css/custom.min.css')}}" rel="stylesheet">
    
    <!--script>
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    </script-->

    <!-- iCheck -->
    <link href="{{asset('assets/datatables/iCheck/skins/flat/green.css')}}" rel="stylesheet">

    <!-- Datatables -->
    <link href="{{asset('assets/datatables/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/datatables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/datatables/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/datatables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/datatables/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    <style>
        fieldset 
    {
        border: 1px outset blue !important;
        margin: 0;
        xmin-width: 0;
        padding: 10px;       
        position: relative;
        border-radius:4px;
        background-color:white;
        padding-left:10px!important;
    }   
    
        legend
        {
            font-size:14px;
            font-weight:bold;
            margin-bottom: 0px; 
            width: 30%; 
            border: 1px outset blue;
            border-radius: 4px; 
            padding: 5px 5px 5px 10px; 
            background-color: #ffffff;
        }
    </style>
    @yield('import')
    <script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
    
  </head>
  @yield('body')
</html>