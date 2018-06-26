<!---Author:Amol Tribhuwan********************************-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mahasystems! </title>


    
    <!-- Bootstrap -->
    <link href="{{asset('assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('assets/vendors/nprogress/nprogress.css')}}" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="{{asset('assets/css/custom.min.css')}}" rel="stylesheet">

    
    <!-- build:[href] components/datetimepicker/css/ -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/datetimepicker/css/bootstrap-datetimepicker.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/datetimepicker/css/pmd-datetimepicker.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/datetimepicker/dateTimeIcon/dateTimeIcon.min.css')}}"/>
<!-- /build -->

     <!-- iCheck -->
    <link href="{{asset('assets/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
 
   <!-- Datatables -->
    <link href="{{asset('assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    
    <!--script>
        function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 0);
        window.onunload=function(){null};
    </script-->
    @yield('import')
    <script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
    <style type="text/css">
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
  </head>
  @yield('body')
</html>