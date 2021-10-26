<!DOCTYPE html>
<html lang="en">
  <head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1JPGF2KS71"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-1JPGF2KS71');
</script>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
      <meta name="_token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{env('company_name')}}| @yield('title') </title>

<link rel="icon" type="image/png" href="{{env('base_url')}}assets/favicon.png">
  <!-- Bootstrap -->
    <link href="{{env('base_url')}}user/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{env('base_url')}}user/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{env('base_url')}}user/vendors/nprogress/nprogress.css" rel="stylesheet">
  
    <!-- Custom Theme Style -->
    <link href="{{env('base_url')}}user/build/css/custom.min.css" rel="stylesheet">

   

    <!-- Datatables -->
    <link href="{{env('base_url')}}user/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{env('base_url')}}user/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="{{env('base_url')}}user/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="{{env('base_url')}}user/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="{{env('base_url')}}user/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
      <link href="{{env('base_url')}}user/css/bootstrap-datepicker.min.css" rel="stylesheet">
      <link href="{{env('base_url')}}user/css/tree.css" rel="stylesheet">
   
<style type="text/css">
  #overlay{
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 999;
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: none;
}
</style>
    
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/home" class="site_title"> <span>{{Auth::user()->name}}</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
				@if(Auth::user()->profile_photo)
				<img src="{{env('base_url')}}assets/user/{{Auth::user()->id}}/profile/{{Auth::user()->profile_photo}}" class="img-circle profile_img" alt="User Image"> @else @if(Auth::user()->gender == "m")
				<img src="{{env('base_url')}}dist/img/avatar.png" class="img-circle profile_img" alt="{{Auth::user()->name}}"> @else
				<img src="{{env('base_url')}}dist/img/avatar2.png" class="img-circle profile_img" alt="{{Auth::user()->name}}"> @endif @endif
              </div>
              <div class="profile_info">
                <span>Welcome, {{Auth::user()->name}}</span>
                <h2>{{ Auth::user()->user_key}}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li>
                  <a href="/user/upgrade/package" class="bg-red">Upgrade Package </a>
                  </li>
                  <li><a href="/home"><i class="fa fa-home" style="color: #FFF;"></i> Dashboard </a></li>
                  <li><a href="/member/add-new"><i class="fa fa-user" style="color: #FFF;"></i> Add New Member</a></li>
                  


                  
                  <li><a><i class="fa fa-cog" style="color: #FFF;"></i> Profile <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/member/profile">Update</a></li>
                      
                      <li><a href="/member/welcome-letter">Welcome Letter</a></li>
                      @if(Auth::user()->package_id)
                      <li><a href="/invoice">Invoice</a></li>
                      @else
                      <li><a href="">Invoice - <span class="bg-white">Pending</span></a></li>
                      @endif
                    </ul>
                  </li>
                  <li><a><i class="fa fa-users" style="color: #FFF;"></i> Team <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/member/direct">Direct</a></li>
                      <li><a href="/member/my-team">Full Team</a></li>
                      <li><a href="/member/level">Level</a></li>
                      <li><a href="#">Genealogy</a></li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-thumb-tack " style="color: #FFF;"></i> Pin Center <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/pin/request">Request Pin</a></li>
                      <li><a href="/pin/request/record">Request Pin Record</a></li>
                      <li><a href="/pin/list">My Pins</a></li>
                    </ul>
                  </li>
             
                  
                  <li><a><i class="fa fa-file " style="color: #FFF;"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/report/tds">TDS</a></li>
                      <li><a href="/report/dispatch">Dispatch</a></li>
                    </ul>
                  </li>


                  
                <li><a href="/support"><i class="fa fa-support" style="color: #FFF;"></i> Support</a></li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Business</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-edit" style="color: #FFF;"></i> Account <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="/payout/payments">Payments</a></li>
                      
                      <li><a href="/payout/all_payout">Report</a></li>
                      <li><a href="/payout/passbook">Passbook</a></li>
                      <li><a href="/user/upgrade/history">Upgrade Package History</a></li>
                      
                      
                      
                    </ul>
                  </li>
                </ul>
              </div>


            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              
              
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle" style="color: #fff;"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="color: #fff;">
                    @if(Auth::user()->profile_photo)
				<img src="{{env('base_url')}}assets/user/{{Auth::user()->id}}/profile/{{Auth::user()->profile_photo}}" alt="User Image"> @else @if(Auth::user()->gender == "m")
				<img src="{{env('base_url')}}dist/img/avatar.png" alt="{{Auth::user()->name}}"> @else
				<img src="{{env('base_url')}}dist/img/avatar2.png" alt="{{Auth::user()->name}}"> @endif @endif
        <span style="color: #fff;">{{ Auth::user()->user_key}}</span>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="/member/profile"> Profile</a></li>
                    
                    <li>
                      <a  href="{{ url('/logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" >
                        <i class="fa fa-sign-out pull-right"></i> Log Out
                    </a>
                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                    </form>

                     </li>
                  </ul>
                </li>
           
             
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
@yield('content')


        <!-- footer content -->
        <footer>
          <div class="pull-right">
            {{env('company_name')}} <span class="text-left"> Powered By <a href="https://acewebmaster.co.in" target="_blank" class="text-primary">Ace WebMaster</a> </span>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{env('base_url')}}user/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{env('base_url')}}user/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{env('base_url')}}user/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{env('base_url')}}user/vendors/nprogress/nprogress.js"></script>
    
    <!-- jQuery Sparklines -->
    <script src="{{env('base_url')}}user/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    
    
    <!-- DateJS -->
    <script src="{{env('base_url')}}user/vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{env('base_url')}}user/vendors/moment/min/moment.min.js"></script>
     <script src="{{env('base_url')}}user/js/bootstrap-datepicker.min.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{env('base_url')}}user/build/js/custom.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.21.1/dist/sweetalert2.all.js"></script>
    <script src="{{env('base_url')}}user/js/style.js"></script>
    <script src="{{env('base_url')}}user/js/jsform.js"></script>
    <script src="{{env('base_url')}}user/js/generationLevel.js"></script>

   
    
    
    <!-- validator -->
    <script src="{{env('base_url')}}user/vendors/validator/validator.js"></script>

    <!-- Datatables -->
    <script src="{{env('base_url')}}user/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{env('base_url')}}user/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/jszip/dist/jszip.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{env('base_url')}}user/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
      <script type="text/javascript">
    $('.dob').datepicker({
    format: 'yyyy-mm-dd',
    endDate: '-18y',
    autoclose: true,
    });
    

    $("form").submit(function(e){
      var res = $(this).valid();
      if(res==true){

        $("#overlay").show();
            swal({
            title: 'Please wait while processing your request',
            text: "Please don't refresh or back your page",
            allowOutsideClick: () => !swal.isLoading(),
            onOpen: () => {
            swal.showLoading()
            }
        }).then((result) => {
        if (
        // Read more about handling dismissals
        result.dismiss === swal.DismissReason.timer
        ) {
        console.log('I was closed by the timer')
        }
        })
      }else{
        return false;
      }

    });
    </script>

    @if(Session::has('message'))
      <script type="text/javascript">
         Swal.fire({
         position: 'center',
         icon: '<?php echo Session::get('icon'); ?>',
         title: '<?php echo Session::get('message'); ?>',
         showConfirmButton: true,
         })
         
      </script>
      @endif


  </body>
</html>