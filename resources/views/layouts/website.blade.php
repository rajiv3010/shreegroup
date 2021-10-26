<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="author" content="SemiColonWeb" />

   <!-- Stylesheets
   ============================================= -->
   <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" href="{{env('base_url')}}front/css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="{{env('base_url')}}front/style.css" type="text/css" />
   <link rel="stylesheet" href="{{env('base_url')}}front/css/dark.css" type="text/css" />

   <!-- Travel Demo Specific Stylesheet -->
   <link rel="stylesheet" href="{{env('base_url')}}front/travel/travel.css" type="text/css" />
   <link rel="stylesheet" href="{{env('base_url')}}front/css/components/datepicker.css" type="text/css" />
   <!-- / -->

   <link rel="stylesheet" href="{{env('base_url')}}front/css/font-icons.css" type="text/css" />
   <link rel="stylesheet" href="{{env('base_url')}}front/css/animate.css" type="text/css" />
   <link rel="stylesheet" href="{{env('base_url')}}front/css/magnific-popup.css" type="text/css" />

   <link rel="stylesheet" href="{{env('base_url')}}front/css/custom.css" type="text/css" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <link rel="stylesheet" href="{{env('base_url')}}front/css/colors.php?color=AC4147" type="text/css" />


   <!-- Document Title
   ============================================= -->
   <title>{{env('company_name')}} | Your Travel Partner</title>

</head>

<body class="stretched">

   <!-- Document Wrapper
   ============================================= -->
   <div id="wrapper" class="clearfix">

      <!-- Top Bar
      ============================================= -->
      <div id="top-bar" class="transparent-topbar dark">
         <div class="container">

            <div class="row justify-content-between">
               <div class="col-12 col-md-auto">

                  <!-- Top Links
                  ============================================= -->
                  <div class="top-links">
                     <ul class="top-links-container">
                        <li class="top-links-item"><a href="/">Home</a></li>
                        <li class="top-links-item"><a href="/member/login">Login</a></li>
                       
                     </ul>
                  </div><!-- .top-links end -->

               </div>

               <div class="col-12 col-md-auto">

                  <!-- Top Social
                  ============================================= -->
                  <ul id="top-social">
                     <li><a href="#" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
                     <li><a href="#" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a></li>
                     
                     <li><a href="#" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
                     <li><a href="tel:{{env('company_phone1')}}" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">{{env('company_phone1')}}</span></a></li>
                     <li><a href="mailto:{{env('company_email_helpline')}}" class="si-email3"><span class="ts-icon"><i class="icon-envelope-alt"></i></span><span class="ts-text">{{env('company_email_helpline')}}</span></a></li>
                  </ul><!-- #top-social end -->

               </div>
            </div>

         </div>
      </div><!-- #top-bar end -->

      <!-- Header
      ============================================= -->
      <header id="header" class="transparent-header dark" data-sticky-class="not-dark" data-responsive-class="not-dark" data-menu-padding="28">
         <div id="header-wrap">
            <div class="container">
               <div class="header-row">

                  <!-- Logo
                  ============================================= -->
                  <div id="logo">
                     <a href="demo-travel.html" class="standard-logo" data-dark-logo="{{env('base_url')}}front/images/logo-dark.png"><img src="{{env('base_url')}}front/images/logo.png" alt="{{env('company_name')}}"></a>
                     <a href="demo-travel.html" class="retina-logo" data-dark-logo="{{env('base_url')}}front/images/logo-dark@2x.png"><img src="{{env('base_url')}}front/images/logo@2x.png" alt="{{env('company_name')}}"></a>
                  </div><!-- #logo end -->

                  <div id="primary-menu-trigger">
                     <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                  </div>

                  <!-- Primary Navigation
                  ============================================= -->
                  <nav class="primary-menu style-4 menu-spacing-margin">

                     <ul class="menu-container">
                        <li class="menu-item current"><a class="menu-link" href="demo-travel.html"><div><i class="icon-home2"></i>Home</div></a></li>
                        <li class="menu-item"><a class="menu-link" href="#"><div><i class="icon-plane"></i>Packages</div></a></li>
                        <li class="menu-item"><a class="menu-link" href="demo-travel-hotels.html"><div><i class="icon-building"></i>Destinations</div></a></li>
                        <li class="menu-item"><a class="menu-link" href="demo-travel-holidays.html"><div><i class="icon-gift"></i>Holidays</div></a></li>
                        <li class="menu-item"><a class="menu-link" href="demo-travel-blog.html"><div><i class="icon-pencil2"></i>About</div></a></li>
                        <li class="menu-item"><a class="menu-link" href="/member/login"><div><i class="icon-user"></i>Login</div></a></li>
                     </ul>

                  </nav><!-- #primary-menu end -->

               </div>
            </div>
         </div>
         <div class="header-wrap-clone"></div>
      </header><!-- #header end -->
    @yield('content')

      <!-- Footer
      ============================================= -->
      <footer id="footer" class="dark" style="background-color: #222;">
         <div class="container">

            <!-- Footer Widgets
            ============================================= -->
            <div class="footer-widgets-wrap">

               <div class="row col-mb-50">
                  <div class="col-md-4">

                     <div class="widget clearfix">

                        <div class="row col-mb-30">
                           <div class="col-lg-12">
                              <div class="footer-big-contacts">
                                 <span>Call Us:</span>
                                 {{env('company_phone1')}}
                              </div>
                           </div>

                           <div class="col-lg-12">
                              <div class="footer-big-contacts">
                                 <span>Send an Enquiry:</span>
                                 {{env('company_email_helpline')}}
                              </div>
                           </div>
                        </div>

                     </div>

                     <div class="widget subscribe-widget clearfix">
                        <div class="row col-mb-30">
                           <div class="col-lg-6">
                              <a href="#" class="social-icon si-dark si-colored si-facebook mb-0" style="margin-right: 10px;">
                                 <i class="icon-facebook"></i>
                                 <i class="icon-facebook"></i>
                              </a>
                              <a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
                           </div>
                           <div class="col-lg-6">
                              <a href="#" class="social-icon si-dark si-colored si-youtube mb-0" style="margin-right: 10px;">
                                 <i class="icon-youtube"></i>
                                 <i class="icon-youtube"></i>
                              </a>
                              <a href="#"><small style="display: block; margin-top: 3px;"><strong>Subscribe</strong><br>to YouTube</small></a>
                           </div>
                        </div>
                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="widget clearfix">
                        <h4>Featured Packages</h4>

                        <div class="posts-sm row col-mb-30" id="travel-package-list-footer">
                           <div class="entry col-12">
                              <div class="grid-inner row align-items-center g-0">
                                 <div class="col-auto">
                                    <div class="entry-image">
                                       <a href="#"><img class="rounded-circle" src="{{env('base_url')}}front/images/magazine/small/1.jpg" alt="Image"></a>
                                    </div>
                                 </div>
                                 <div class="col ps-3">
                                    <div class="entry-title">
                                       <h4><a href="#">7 Nights/8 Days</a></h4>
                                    </div>
                                    <div class="entry-meta">
                                       <ul>
                                          <li><strong>Domestic /</strong> International</li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="entry col-12">
                              <div class="grid-inner row align-items-center g-0">
                                 <div class="col-auto">
                                    <div class="entry-image">
                                       <a href="#"><img class="rounded-circle" src="{{env('base_url')}}front/images/magazine/small/2.jpg" alt="Image"></a>
                                    </div>
                                 </div>
                                 <div class="col ps-3">
                                    <div class="entry-title">
                                       <h4><a href="#">4 Nights/5 Days</a></h4>
                                    </div>
                                    <div class="entry-meta">
                                       <ul>
                                          <li><strong>Domestic /</strong> International</li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="entry col-12">
                              <div class="grid-inner row align-items-center g-0">
                                 <div class="col-auto">
                                    <div class="entry-image">
                                       <a href="#"><img class="rounded-circle" src="{{env('base_url')}}front/images/magazine/small/3.jpg" alt="Image"></a>
                                    </div>
                                 </div>
                                 <div class="col ps-3">
                                    <div class="entry-title">
                                       <h4><a href="#">11 Nights/12 Days</a></h4>
                                    </div>
                                    <div class="entry-meta">
                                       <ul>
                                          <li><strong>Domestic /</strong> International</li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>

                  <div class="col-md-4">

                     <div class="widget widget_links clearfix">

                        <h4>Popular Destinations</h4>

                        <div class="row col-mb-30">
                           <div class="col-6">
                              <ul>
                                 <li><a href="#">Thailand</a></li>
                                 <li><a href="#">Indonesia</a></li>
                                 <li><a href="#">Italy</a></li>
                                 <li><a href="#">Spain</a></li>
                              </ul>
                           </div>
                           <div class="col-6">
                              <ul>
                                 <li><a href="#">India</a></li>
                                 <li><a href="#">France</a></li>
                                 <li><a href="#">Philippines</a></li>
                                 <li><a href="#">New Zealand</a></li>
                              </ul>
                           </div>
                        </div>

                     </div>

                     <!-- <div class="widget subscribe-widget clearfix">
                        <h5>Get Latest <strong>Offers</strong> &amp; <strong>Coupons</strong> by Email:</h5>
                        <div class="widget-subscribe-form-result"></div>
                        <form id="widget-subscribe-form" action="include/subscribe.php" method="post" class="mb-0">
                           <div class="input-group mx-auto">
                              <div class="input-group-text"><i class="icon-email2"></i></div>
                              <input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">
                              <button class="btn btn-danger bg-color" type="submit">Subscribe</button>
                           </div>
                        </form>
                     </div> -->

                  </div>
               </div>

            </div><!-- .footer-widgets-wrap end -->

         </div>

         <!-- Copyrights
         ============================================= -->
         <div id="copyrights">
            <div class="container">

               <div class="row col-mb-30">

                  <div class="col-md-6 text-center text-md-start">
                     Copyrights &copy; 2021 All Rights Reserved by {{env('company_name')}}.<br>
                     <div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
                  </div>

                  <div class="col-md-6 text-center text-md-end">
                     <div class="d-flex justify-content-center justify-content-md-end">
                        <a href="#" class="social-icon si-small si-borderless si-facebook">
                           <i class="icon-facebook"></i>
                           <i class="icon-facebook"></i>
                        </a>

                        <a href="#" class="social-icon si-small si-borderless si-twitter">
                           <i class="icon-twitter"></i>
                           <i class="icon-twitter"></i>
                        </a>

                        <a href="#" class="social-icon si-small si-borderless si-youtube">
                           <i class="icon-youtube"></i>
                           <i class="icon-youtube"></i>
                        </a>


                      
                     </div>

                     <div class="clear"></div>

                     <i class="icon-envelope2"></i> {{env('company_email_helpline')}} <span class="middot">&middot;</span> <i class="icon-headphones"></i> {{env('company_phone1')}}
                  </div>

               </div>

            </div>
         </div><!-- #copyrights end -->
      </footer><!-- #footer end -->

   </div><!-- #wrapper end -->

   <!-- Go To Top
   ============================================= -->
   <div id="gotoTop" class="icon-angle-up"></div>

   <!-- JavaScripts
   ============================================= -->
   <script src="{{env('base_url')}}front/js/jquery.js"></script>
   <script src="{{env('base_url')}}front/js/plugins.min.js"></script>
   <script src="https://maps.google.com/maps/api/js?key=YOUR-API-KEY"></script>

   <!-- Travel Demo Specific Script -->
   <script src="{{env('base_url')}}front/js/components/datepicker.js"></script>
   <!-- / -->

   <!-- Footer Scripts
   ============================================= -->
   <script src="{{env('base_url')}}front/js/functions.js"></script>

   <script>

      $(function() {
         $('.travel-date-group').datepicker({
            autoclose: true,
            startDate: "today"
         });
      });

   </script>

</body>
</html>