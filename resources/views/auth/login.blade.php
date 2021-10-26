<!DOCTYPE html>
<html dir="ltr" lang="en-US">
   <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <meta name="author" content="{{env('company_name')}}" />
      <!-- Stylesheets
         ============================================= -->
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="{{env('base_url')}}login/css/bootstrap.css" type="text/css" />
      <link rel="stylesheet" href="{{env('base_url')}}login/css/style.css" type="text/css" />
      <link rel="stylesheet" href="{{env('base_url')}}login/css/dark.css" type="text/css" />
      <link rel="stylesheet" href="{{env('base_url')}}login/css/font-icons.css" type="text/css" />
      <link rel="stylesheet" href="{{env('base_url')}}login/css/animate.css" type="text/css" />
      <link rel="stylesheet" href="{{env('base_url')}}login/css/magnific-popup.css" type="text/css" />
      <link rel="stylesheet" href="{{env('base_url')}}login/css/responsive.css" type="text/css" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <!-- Document Title
         ============================================= -->
      <title>Login - {{env('company_name')}}</title>
   </head>
   <body class="stretched">
      <!-- Document Wrapper
         ============================================= -->
      <div id="wrapper" class="clearfix">
         <!-- Content
            ============================================= -->
         <section id="content">
            <div class="content-wrap nopadding">
               <div class="section nopadding nomargin" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0; background: #444;"></div>
               <div class="section nobg full-screen nopadding nomargin">
                  <div class="container-fluid vertical-middle divcenter clearfix">
                     <div class="card divcenter noradius noborder" style="max-width: 400px;">
                        <div class="card-body" style="padding: 40px;">
                           <div class="center">
                              <a href="/"><img src="{{env('base_url')}}login/images/logo.png" alt="{{env('company_name')}}" style="width: 200px;"></a>
                              <br>
                              <h3>Login to your Account</h3>
                           </div>
                           @if ($errors->any())
                           <div class="text-danger">
                              <ul>
                                 @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                                 @endforeach
                              </ul>
                           </div>
                           @endif
                           <form class="nobottommargin" action="/member/login" method="POST">
                              @csrf
                              <div class="col_full">
                                 <label for="login-form-username">User name:</label>
                                 <input type="text" id="login-form-username" name="user_name" value="" class="form-control not-dark" />
                              </div>
                              <div class="col_full">
                                 <label for="login-form-password">Password:</label>
                                 <input type="password" id="login-form-password" name="password" value="" class="form-control not-dark" />
                              </div>
                              <div class="col_full nobottommargin">
                                 <button class="button button-3d button-black nomargin" type="submit">Login</button>
                                 <!-- <a href="/user/password-reset" class="fright">Forgot Password?</a> -->
                              </div>
                           </form>
                           <div class="line line-sm"></div>
                        </div>
                     </div>
                     <div class="center dark">
                        <small>
                           Copyrights &copy; <script>document.write( new Date().getFullYear() );</script>, All rights reserved | By <a href="{{env('company_website')}}" target="_blank">{{env('company_name')}}</a>
                        </small>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- #content end -->
      </div>
      <!-- #wrapper end -->
      <!-- Go To Top
         ============================================= -->
      <div id="gotoTop" class="icon-angle-up"></div>
      <!-- External JavaScripts
         ============================================= -->
      <script src="{{env('base_url')}}login/js/jquery.js"></script>
      <script src="{{env('base_url')}}login/js/plugins.js"></script>
      <!-- Footer Scripts
         ============================================= -->
      <script src="{{env('base_url')}}login/js/functions.js"></script>
   </body>
</html>