<!DOCTYPE html>
<html>
   <head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1JPGF2KS71"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-1JPGF2KS71');
</script>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>{{env('company_name')}} | @yield('title')</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="_token" content="{{ csrf_token() }}">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.6 -->
      <link rel="stylesheet" href="{{env('base_url')}}admin/bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{env('base_url')}}admin/dist/css/AdminLTE.min.css">
      <link rel="stylesheet" href="{{env('base_url')}}admin/bower_components/ckeditor/style.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="{{env('base_url')}}admin/dist/css/skins/_all-skins.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="{{env('base_url')}}admin/plugins/iCheck/flat/blue.css">
      <!-- Morris chart -->
      <link rel="stylesheet" href="{{env('base_url')}}admin/plugins/morris/morris.css">
      <link rel="stylesheet" href="{{env('base_url')}}admin/css/style.css">
      <link rel="stylesheet" href="{{env('base_url')}}admin/plugins/select2/select2.css">
      <link href="{{env('base_url')}}admin/css/jquerytimepicker.css" rel="stylesheet">
      <link href="{{env('base_url')}}admin/css/lightbox.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
      <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-notifications.min.css">
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
  .autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
</style>  </head>
   <body class="hold-transition skin-blue sidebar-mini">
      <div class="wrapper">

        
          @if(Session::has('message'))
         <div class="alert alert-success" style="position: absolute;right: 30px;z-index: 9999">
            <p>{{Session::get('message') }}</p>
         </div>
         @endif
         <header class="main-header adminHeader">
            <!-- Logo -->
            <a href="/admin/dashboard" class="logo">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <span class="logo-mini"><b>N</b>B</span>
               <!-- logo for regular state and mobile devices -->
               <span class="logo-lg"><b>{{env('company_name')}}</b></span>
            </a>
             
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
               <!-- Sidebar toggle button-->
               <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
               <span class="sr-only">Toggle navigation</span>
               </a>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                     <!-- Messages: style can be found in dropdown.less-->
                     <li>
                         <a  href="{{ url('/admin/logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" >
                                 <i class="fa fa-sign-out" aria-hidden="true"></i>  Sign out
                                 </a>
                                 <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                 </form>
                     </li>

                   
                     <!-- Control Sidebar Toggle Button -->
                     <!-- <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li> -->
                  </ul>
               </div>
            </nav>
         </header>
         <!-- Left side column. contains the logo and sidebar -->
         <!-- sidebar -->
         <!-- Left side column. contains the logo and sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
               <!-- Sidebar user panel -->
              
               
               <!-- sidebar menu: : style can be found in sidebar.less -->
               <ul class="sidebar-menu">
                  <li class="active treeview">
                     <a href="/admin/home">
                     <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                     </a>
                  </li>
                  <li class="treeview">
                     <a href="/admin/support/0">
                     <i class="fa fa-envelope"></i> <span>Support</span>
                     </a>
                  </li>

                  
                  
                  
                
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-group"></i>
                     <span>Members</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/user"><i class="fa fa-circle-o"></i>Members</a></li>
                        <li><a href="/admin/user/banned"><i class="fa fa-circle-o"></i>Blocked Member</a></li>
                        <li><a href="/admin/user/approve-kyc"><i class="fa fa-circle-o"></i>Approve KYC</a></li>
                        <li><a href="/admin/user/approve-bank-kyc"><i class="fa fa-circle-o"></i>Approve Bank KYC</a></li>
                        <li><a href="/admin/user/ROI-user-list"><i class="fa fa-circle-o"></i>ROI User</a></li>
                  
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-briefcase"></i>
                     <span>Packages</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/package"><i class="fa fa-circle-o"></i>Add</a></li>
                        <li><a href="/admin/package/show"><i class="fa fa-circle-o"></i>View</a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-arrow-up"></i>
                     <span>Pin</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/pin/"><i class="fa fa-circle-o"></i>View Pin</a></li>
                        <li><a href="/admin/pin/request"><i class="fa fa-circle-o"></i>Pin Request</a></li>
                        
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-credit-card"></i>
                     <span>Payment</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/user-payment"><i class="fa fa-circle-o"></i>Payment List</a></li>
                        
                        <li><a href="/admin/payment/stop"><i class="fa fa-circle-o"></i>Stopped Payment</a></li>
                        <li><a href="/admin/payment/release"><i class="fa fa-circle-o"></i>Release Payment</a></li>
                        <li><a href="/admin/payment/release/history"><i class="fa fa-circle-o"></i>Release Payment History</a></li>
                        <li><a href="/admin/user-payment/pending-kyc"><i class="fa fa-circle-o"></i>Pending KYC</a></li>
                     </ul>
                  </li>

                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-files-o"></i>
                     <span>Report</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/report/tds"><i class="fa fa-circle-o"></i>TDS report</a></li>
                        <li><a href="/admin/report/sale"><i class="fa fa-circle-o"></i>Sale report</a></li>
                        <li><a href="/admin/report/payouts"><i class="fa fa-circle-o"></i>Payouts</a></li>
                        <li><a href="/admin/report/payments"><i class="fa fa-circle-o"></i>Payments</a></li>
                        <li><a href="/admin/distributions"><i class="fa fa-circle-o"></i>Distributions</a></li>
                        <!-- <li><a href="/admin/report/income-report"><i class="fa fa-circle-o"></i>Income report</a></li> -->
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-caret-square-o-down"></i>
                     <span>Banking</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/banking"><i class="fa fa-circle-o"></i>List</a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-caret-square-o-down"></i>
                     <span>Testimonials</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/testimonials"><i class="fa fa-circle-o"></i>List</a></li>
                        <li><a href="/admin/testimonials/add"><i class="fa fa-circle-o"></i>Add New</a></li>
                     </ul>
                  </li>
                  

                  

                  <li class="treeview">
                     <a href="/admin/change-password">
                     <i class="fa fa-key"></i> <span>Password</span>
                     </a>
                  </li>

                  <li class="treeview">
                     <a href="/admin/queries">
                     <i class="fa fa-key"></i> <span>Web Enquiries</span>
                     </a>
                  </li>
                  <li class="treeview">
                     <a href="/admin/dashboard-images">
                     <i class="fa fa-key"></i> <span>Dashboard Images</span>
                     </a>
                  </li>

                  <li class="treeview">
                     <a href="/admin/videos">
                     <i class="fa fa-key"></i> <span>Upload Video</span>
                     </a>
                  </li>

                  <li class="treeview">
                     <a href="/admin/download">
                     <i class="fa fa-key"></i> <span>Upload Download Documents</span>
                     </a>
                  </li>
                  
                  
                 <!--  <li class="treeview">
                     <a href="/admin/roles">
                     <i class="fa fa-key"></i> <span>Assign Roles</span>
                     </a>
                  </li>
                   -->
                  
                  

               </ul>
            </section>
            <!-- /.sidebar -->
         </aside>
         <!-- sidebar -->
         @yield('content')
         <!-- footer -->
         <!-- /.content-wrapper -->
         <footer class="main-footer">
      <strong>Copyright &copy; {{date('Y')}} <a href="{{env('company_website')}}">{{env('company_name')}}</a></strong> &nbsp;&nbsp; <span class="text-left"> Powered By <a href="https://acewebmaster.co.in" target="_blank">Ace WebMaster</a> </span>
         </footer>
      }
      </div>
      <!-- ./wrapper -->
      <!-- AdminLTE for demo purposes -->
      <!-- CK Editor -->
      <!-- jQuery UI 1.11.4 -->
      <script src="{{env('base_url')}}admin/bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="{{env('base_url')}}admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- FastClick -->
      <script src="{{env('base_url')}}admin/bower_components/fastclick/lib/fastclick.js"></script>
      <!-- AdminLTE App -->
      <script src="{{env('base_url')}}admin/dist/js/adminlte.min.js"></script>
      <!-- Sparkline -->
      <script src="{{env('base_url')}}admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
      <!-- jvectormap  -->
      <script src="{{env('base_url')}}admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
      <script src="{{env('base_url')}}admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
      <!-- SlimScroll -->
      <script src="{{env('base_url')}}admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <!-- <script src="{{env('base_url')}}admin/dist/js/pages/dashboard2.js"></script> -->
      <!-- AdminLTE for demo purposes -->
      <script src="{{env('base_url')}}admin/dist/js/demo.js"></script>
      <!-- daterangepicker -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
      <script src="{{env('base_url')}}admin/plugins/daterangepicker/daterangepicker.js"></script>
      <!-- datepicker -->
      <script src="{{env('base_url')}}admin/plugins/datepicker/bootstrap-datepicker.js"></script>
      <!-- Bootstrap WYSIHTML5 -->
      <!-- Slimscroll -->
      <script src="{{env('base_url')}}admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
      <!-- FastClick -->
      <script src="{{env('base_url')}}admin/plugins/fastclick/fastclick.js"></script>
      <!-- AdminLTE App -->
      <script src="{{env('base_url')}}admin/dist/js/app.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script src="{{env('base_url')}}admin/js/jsform.min.js"></script>
      @if (request()->is('referal/generation-level'))
      <script src="{{env('base_url')}}admin/js/generationLevel.js"></script>
      @endif
      <!-- jQuery 3 -->
      <!-- Bootstrap 3.3.7 -->
      <!-- FastClick -->
      <script src="{{env('base_url')}}admin/bower_components/fastclick/lib/fastclick.js"></script>
      <script src="{{env('base_url')}}admin/bower_components/ckeditor/ckeditor.js"></script>
      <!-- Bootstrap WYSIHTML5 -->
<!--       <script src="{{env('base_url')}}admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
 -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
      <script src="{{env('base_url')}}admin/myjs/jquery.timepicker.min.js"></script>
      <script src="https://unpkg.com/sweetalert2@7.21.1/dist/sweetalert2.all.js"></script>
      <script src="{{env('base_url')}}admin/js/style.js"></script>
      <script src="{{env('base_url')}}admin/js/query.autocomplete.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<!-- table -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<!-- table -->
      <script type="text/javascript">

         $(document).ready(function() {
    $('table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
         $(document).ready( function () {;
         $('.dataTables').DataTable();
       $("form").submit(function(e){
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

    });
    $(".VerifyInvoiceWithConfirm").click(function(e){

      if (confirm("Are you sure?")) {
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
            return true;

    }
    return false;

 });

  $(".loaderPage").click(function(e){
   $("input[type='submit']", this)
      .val("Please Wait...")
      .attr('disabled', 'disabled');
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

 });
var clicked = false;
function processClick() {
    if (clicked) return;
    clicked = true; 
}
  $("body").on('keyup','.perIDCostManual',function(){
      var key = $(this).attr('data-key-id');
      var sell = parseInt($(".sell"+key).text());
      var achievers = parseInt($(".achievers"+key).text());
      var PCID = parseInt($(this).val());
      var turnover = sell*PCID;
      var distributionPerID = parseInt(turnover)/achievers;
      $(".currentTurnOver"+key).html(turnover);
      $(".distributionPerID"+key).html(distributionPerID);
  });
  
  $("body").on('change','.BCDateSearch',function(){
   var url      = window.location.href; 
   window.location.href = url+'?date='+$(this).val();
  });
  
  $("body").on('click','.addRejectReasonForLead',function(){
            var user_key = $(this).attr('data-user-key');
            var id =  $(this).attr('data-ref-id');
            $("#rej_id").val(id);
            $("#rej_userKey").val(user_key);
            $("#addMessageForRejection").modal('show');
      });

  $("body").on('click','.addDocument',function(){
            var user_key = $(this).attr('data-user-key');
            var id =  $(this).attr('data-ref-id');
            $("#accept_id").val(id);
            $("#accept_userKey").val(user_key);
            $("#addDocumentRegistry").modal('show');
      });
  
});
</script>
     <script src="https://js.pusher.com/6.0/pusher.min.js"></script>



  <script type="text/javascript">
      var pusher = new Pusher('9baf09976fc08b6831b7', {
        encrypted: true,
        cluster:"ap2"
      });
      // Subscribe to the channel we specified in our Laravel Event
      var channel = pusher.subscribe('status-liked');
      // Bind a function to a Event (the full Laravel class)
     channel.bind('App\\Events\\StatusLiked', function(data) {
        alert(data.message);
      });

      var notificationsWrapper   = $('.noti');
      var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
      var notificationsCountElem = notificationsToggle.find('i[data-count]');
      var notificationsCount     = parseInt(notificationsCountElem.data('count'));
      var notifications          = $('ul.notiList');

      if (notificationsCount <= 0) {
        notificationsWrapper.hide();
      }

      // Enable pusher logging - don't include this in production
      // Pusher.logToConsole = true;

      // Subscribe to the channel we specified in our Laravel Event


      // Bind a function to a Event (the full Laravel class)
      channel.bind('App\\Events\\StatusLiked', function(data) {
        var existingNotifications = notifications.html();
        var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
        var newNotificationHtml = `<li><a href=""><i class="fa fa-circle-o"></i>`+data.message+`</a></li>
        `;
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        $('.ncount').text(notificationsCount);
        notificationsWrapper.show();
      });


      var order = pusher.subscribe('status-ref-user');
      // Bind a function to a Event (the full Laravel class)
      order.bind('App\\Events\\StatusRefUser', function(data) {
        alert(data.message);
      });

  $(".checkAllPaymentIds").click(function(){
     $('input:checkbox').not(this).prop('checked', this.checked);
  });

         
         $(document).on('click','.giveManualPermission',function () {
                  $("#user_key").val($(this).attr('data-user-key'));
  });   

         $(document).on('click','.levelpercentagelimit',function () {
                  $("#packagePercentagelLimit").val($(this).attr('data-limit-percentage'));
  }); 


         $(document).on('click','.AssignManualRole',function () {
                  $("#user_id").val($(this).attr('data-user-key'));
  }); 



         $("body").on('click','.levelpercentagelimit',function(){
            var level_limit = $(this).attr('data-limit-percentage');
            var id =  $(this).attr('data-package-id');
            $("#levelLimit").val(level_limit);
            $("#packageID").val(id);
            $("#LevelLimitPercentage").modal('show');

            var level_limit_html = "";
         for(var i = 1; i <= level_limit; i++) {
            level_limit_html += '<div class="form-group">';
             level_limit_html +=    '<label class="control-label col-sm-8" for="earning">Level '+i+' Income:</label>';
                 level_limit_html += '<div class="col-sm-4">';
                   level_limit_html +='<input type="number" class="form-control" id="percentage" name="percentage[]" placeholder="Enter %">';
                 level_limit_html +='</div>';
               level_limit_html +='</div>';
            }
            $(".level_list").html(level_limit_html);

            var level_limit_percentage_html = "";
         for(var i = 1; i <= level_limit; i++) {
            level_limit_percentage_html += '<div class="form-group">';
             level_limit_percentage_html +=    '<label class="control-label col-sm-8" for="earning">Level '+i+' Direct:</label>';
                 level_limit_percentage_html += '<div class="col-sm-4">';
                   level_limit_percentage_html +='<input type="number" class="form-control" id="direct"  value="'+i+'" readonly name="direct[]" placeholder="Enter Direct">';
                 level_limit_percentage_html +='</div>';
               level_limit_percentage_html +='</div>';
            }
            $(".level_list_condition").html(level_limit_percentage_html);
            

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
<!-- footer -->