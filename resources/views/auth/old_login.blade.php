<!DOCTYPE html>
<html>
<head>
<title>Login - {{env('company_name')}}</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="{{env('company_name')}}" />

     <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <!-- Custom Theme files -->
    <link href="{{env('base_url')}}login/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="{{env('base_url')}}login/css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->

    <!-- web font -->
    <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
    <!-- //web font -->

</head>
<body>

<!-- main -->
<div class="w3layouts-main"> 
    <div class="bg-layer">
        <h1>{{env('company_name')}} - Login 1111111</h1>

        <div class="header-main">
            <div class="main-icon">
                <img src="{{env('base_url')}}login/images/logo.png" width="50">
            </div>
            <div class="header-left-bottom">
                <form action="/login" method="POST">
                    @csrf
                    <div class="icon1">
                        <span class="fa fa-user"></span>
                        <input type="text"  name="user_key" placeholder="TID" required=""/>
                    </div>
                    <div class="icon1">
                        <span class="fa fa-lock"></span>
                        <input type="password" name="password" placeholder="Password" required=""/>
                    </div>
                    <div class="login-check">
                         <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i> Keep me logged in</label>
                    </div>
                     <!-- <div class="login-check">
                        <a href="/user/password-reset" class="link checkbox" ><i class="fa fa-lock"></i> Forgot Password</a>
                    </div> -->
                    <div class="bottom">
                        <button type="submit" class="btn">Log In</button>
                    </div>
                    <div class="links">
                        <div class="clear"></div>
                    </div>
                </form>
            </div>
            
        </div>
        
        <!-- copyright -->
        <div class="copyright">
            <p>© <script>document.write( new Date().getFullYear() );</script> All rights reserved | By <a href="{{env('company_website')}}" target="_blank">{{env('company_name')}}</a></p>
        </div>
        <!-- //copyright --> 
    </div>
</div>  
<!-- //main -->

</body>
</html>