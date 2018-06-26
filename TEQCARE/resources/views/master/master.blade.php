@extends('layout.header')
  @section('body')
  <body class="nav-md">
  <div class="container body">
      <div class="main_container">
        <div class="col-md-3 col-sm-3 col-xs-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a class="site_title"><span><img src="{{asset('assets/images/logo.gif')}}" width="160" alt="TEQ CARE"></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('assets/images/adm.jpg')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
              <span>Welcome,</span>
              </div>
              <div class="form-group" align="center">
              <h2><?php echo Auth::user()->username;?>
                   </h2>
                   </div>
            </div>
            <!-- /menu profile quick info -->
			<br/>
               <?php
                    echo Session::get('navigation');
                ?>

            <!-- /menu footer buttons -->
            
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation-->
        <div class="top_nav">

          <div class="nav_menu">
            
            <nav>

              <div class="nav toggle">

                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('assets/images/adm.jpg')}}" alt=""><?php echo Auth::user()->username; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="{{URL::to('logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
              @yield('pageContent')
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">

          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    
    <!-- Bootstrap -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('assets/js/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('assets/js/nprogress.js')}}"></script>
  <!-- Chart.js -->
    <script src="{{asset('assets/js/Chart.min.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{asset('assets/js/custom.min.js')}}"></script>


    <script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/jszip.min.js')}}"></script>
    <script src="{{asset('assets/js/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/js/vfs_fonts.js')}}"></script>


     <!-- bootstrap-daterangepicker -->
    <script src="{{asset('assets/js/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/daterangepicker.js')}}"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <!-- Ion.RangeSlider -->
    <script src="{{asset('assets/js/ion.rangeSlider.min.js')}}"></script>

    <!-- jQuery Smart Wizard -->
    <script src="{{asset('assets/js/jquery.smartWizard.js')}}"></script>


    <script src="{{asset('assets/js/jquery.inputmask.bundle.min.js')}}"></script>
    <script type="text/javascript">
    $(document).ready(function () {
            if($('#errorMsg').text()!=null && $('#errorMsg').text()!=undefined)
            {
                $('#errorMsg').delay(4000).fadeOut('slow');
            }
            if($('#succMsg').text()!=null && $('#errorMsg').text()!=undefined)
            {
                $('#succMsg').delay(4000).fadeOut('slow');
            }
        });
    </script>
    <!-- Custom Theme Scripts -->
    <!--script src="{{asset('assets/js/build/custom.min.js')}}"></script-->

    <!-- build:[src] components/datetimepicker/js/ -->
<script type="text/javascript" language="javascript" src="{{asset('assets/datetimepicker/js/moment-with-locales.js')}}"></script>
<script type="text/javascript" language="javascript" src="{{asset('assets/datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
<!-- /build -->



    <script>
  $(document).ready(function() {
    var sPath=window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    $(".pmd-sidebar-nav").each(function(){
      $(this).find("a[href='"+sPage+"']").parents(".dropdown").addClass("open");
      $(this).find("a[href='"+sPage+"']").parents(".dropdown").find('.dropdown-menu').css("display", "block");
      $(this).find("a[href='"+sPage+"']").parents(".dropdown").find('a.dropdown-toggle').addClass("active");
      $(this).find("a[href='"+sPage+"']").addClass("active");
    });
    $(".auto-update-year").html(new Date().getFullYear());
  });
</script> 
 

    <script>
  // Default date and time picker
  $('#datetimepicker-default').datetimepicker();
  
  // View mode datepicker [shows only years and month]
  $('#datepicker-view-mode').datetimepicker({
    viewMode: 'years',
    format: 'MM/YYYY'
  });
  
  // Inline datepicker
  $('#datepicker-inline').datetimepicker({
    inline: true
  });
  
  // Time picker only
  $('#timepicker').datetimepicker({
    format: 'LT'
  });
  
  // Linked date and time picker 
  // start date date and time picker 
  $('#datepicker-start').datetimepicker();

  // End date date and time picker 
  $('#datepicker-end').datetimepicker({
    useCurrent: false 
  });
  
  // start date picke on chagne event [select minimun date for end date datepicker]
  $("#datepicker-start").on("dp.change", function (e) {
    $('#datepicker-end').data("DateTimePicker").minDate(e.date);
  });
  // Start date picke on chagne event [select maxmimum date for start date datepicker]
  $("#datepicker-end").on("dp.change", function (e) {
    $('#datepicker-start').data("DateTimePicker").maxDate(e.date);
  });
  
  // Disabled Days of the Week (Disable sunday and saturday) [ 0-Sunday, 1-Monday, 2-Tuesday   3-wednesday 4-Thusday 5-Friday 6-Saturday]
  $('#datepicker-disabled-days').datetimepicker({
     daysOfWeekDisabled: [0, 6]
  });
  
  // Datepicker in popup
  $('#datepicker-popup-inline').datetimepicker({
    inline: true
  });
  
  $("[data-header-left='true']").parent().addClass("pmd-navbar-left");
  
  // Datepicker left header
  $('.datepicker-left-header').datetimepicker({
    'format' : "YYYY-MM-DD HH:mm:ss", // HH:mm:ss
  });
</script>
  </body>
    @endsection