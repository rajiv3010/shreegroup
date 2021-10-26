<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

   <meta http-equiv="content-type" content="text/html; charset=utf-8" />
   <meta name="author" content="{{env('company_name')}}" />

   <meta property="og:description" content="{{env('company_name')}} is a Best Service Provider">
    <meta property="og:url" content="{{env('quirinus_website')}}">
    <meta property="og:title" content="{{env('company_name')}} is a best Service Provider">
    <meta property="og:type" content="{{env('company_name')}} is a best Service Provider">
    <meta property="og:site_name" content="{{env('company_name')}}">

   <!-- Stylesheets
   ============================================= -->
   <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" href="{{env('base_url')}}newfront/css/bootstrap.css" type="text/css" />
   <link rel="stylesheet" href="{{env('base_url')}}newfront/style.css" type="text/css" />
   <link rel="stylesheet" href="{{env('base_url')}}newfront/css/dark.css" type="text/css" />
   <link rel="stylesheet" href="{{env('base_url')}}newfront/css/font-icons.css" type="text/css" />
   <link rel="stylesheet" href="{{env('base_url')}}newfront/css/animate.css" type="text/css" />
   <link rel="stylesheet" href="{{env('base_url')}}newfront/css/magnific-popup.css" type="text/css" />

   <link rel="stylesheet" href="{{env('base_url')}}newfront/css/custom.css" type="text/css" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />

   <!-- Document Title
   ============================================= -->
   <title>{{env('company_name')}}</title>

</head>

<body class="stretched">

   <!-- Document Wrapper
   ============================================= -->
   <div id="wrapper" class="clearfix">

    

   

      <!-- Content
      ============================================= -->
      <section id="content">
         <div class="content-wrap">
            <div class="container clearfix">

               <div class="row">
                  <!-- Postcontent
                  ============================================= -->
                  <div class="postcontent col-lg-12">


                     <!-- Button trigger modal -->

                     <div class="center" style="border-bottom: 5px solid red">
                        <img src="{{env('base_url')}}newfront/shreeLogo.jpeg" width="20%">
                     </div>
                     <div class="row">
                        <div class="col-lg-6 col-md-6 center">
                           
                  <a data-target="#quirinus" data-toggle="modal" >
                     <img src="{{env('base_url')}}newfront/quirinus.jpeg" width="80%">
                  </a>
                           
                        </div>

                        <div class="col-lg-6 col-md-6 center">
                           
                  <a data-target="#janus" data-toggle="modal" >
                     <img src="{{env('base_url')}}newfront/janus.jpeg" width="80%">
                  </a>
                           
                     </div>
</div>
                  
                  
               </div>


                     <!-- quirinus -->
                     <div class="modal fade" id="quirinus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-body">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                 </div>
                                 <div class="modal-body">
                                    <img src="{{env('base_url')}}newfront/welcomeQuirinus.jpeg">
                                 </div>
                                 <div class="modal-footer">
                                 <a href="{{env('quirinus_website')}}" class="btn btn-dark">Enter Website</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                      <!-- janus -->
                     <div class="modal fade" id="janus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                           <div class="modal-body">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                 </div>
                                 <div class="modal-body">
                                    <img src="{{env('base_url')}}newfront/welcomeJanus.jpeg">
                                 </div>
                                 <div class="modal-footer">
                                 <a href="{{env('janus_website')}}" class="btn btn-dark">Enter Website</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div><!-- .postcontent end -->

               </div>

            </div>
         </div>
      </section><!-- #content end -->

    

   </div><!-- #wrapper end -->

   <!-- Go To Top
   ============================================= -->
   <div id="gotoTop" class="icon-angle-up"></div>

   <!-- JavaScripts
   ============================================= -->
   <script src="{{env('base_url')}}newfront/js/jquery.js"></script>
   <script src="{{env('base_url')}}newfront/js/plugins.min.js"></script>

   <!-- Footer Scripts
   ============================================= -->
   <script src="{{env('base_url')}}newfront/js/functions.js"></script>

</body>
</html>