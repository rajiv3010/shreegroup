<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>TDM | Registration</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{env('base_url')}}bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{env('base_url')}}bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{env('base_url')}}bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{env('base_url')}}dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="{{env('base_url')}}css/style.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{env('base_url')}}plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
 <form class="login-form" id="completeDPCRegistration" role="form" method="POST" action="/dpc/register">

        {{ csrf_field() }}

<body class="hold-transition login-page">
    <div class="login-logo">
       <a href="/index2.html"><b>Pay</b>4AD</a>
       <SPAN>DPC Registration</SPAN>
    </div>
<div class="container">
    <div class="login-box-body">
        
      <div id="messageDiv" style="display: none">
      <div id="message"></div>
      </div>
    
  </div>
</div>
<div class="container" id="pin_details">
  <div class="login-box-body">
      <h3 class="login-box-msg">Register</h3>
       <div class="col-md-offset-3">
       <div  class="loading" style="display: none">
      </div>
      <div id="messageDiv" style="display: none">
        <div id="message"></div>
      </div>
       </div>
     <input type="hidden" value="dpc" id="dpc">
        <div class="row" >

          <div class="col-md-6 col-md-offset-3">
          <div class="form-group has-feedback">
          <label>Name</label>
          <input type="text" name="name" id="name"  class="form-control" placeholder="Enter your name">
          </div>        
          @if ($errors->has('name'))
          <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
          </div>
          <div class="col-md-6 col-md-offset-3">
                <div class="form-group has-feedback">
                <label>Package</label>
                <select name="package_id" id="package_id" class="form-control">
                    @foreach($packages as $package)
                      <option value="{{$package->id}}">{{$package->name}}-{{$package->amount}}</option>
                    @endforeach
                </select>
                </div>        
            </div> 
            <div class="col-md-3 col-md-offset-3">
                <div class="form-group has-feedback">
                <label>PIN</label>
                <input type="text" id="pinVerify" name="pin_number" class="form-control" placeholder="Enter Pin">
                </div>
            </div> 
            <div class="col-md-3">
                <div class="form-group has-feedback">
                <label>Verify pin</label>
                  <br>
                  <a class="btn btn-primary" id="verify-pin">verify-pin</a>
                </div>
            </div> 
          <div class="col-md-6 col-md-offset-3">
          <div class="form-group has-feedback">
          <label>Email</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="Enter your Email">
          </div>
          @if ($errors->has('email'))
          <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif        
          </div> 
          <div class="col-md-6 col-md-offset-3">
          <div class="form-group has-feedback">
          <label>Mobile</label>
          <input type="number" id="phone" name="phone" class="form-control" placeholder="Enter your Mobile">
          </div>        
          </div> 
          <div class="col-md-6 col-md-offset-3">
          <div class="form-group has-feedback">
          <label>Password</label>
          <input type="text" id="password" name="password" class="form-control" placeholder="Enter your Password">
          </div>        
          </div> 
          <div class="col-md-6 col-md-offset-3">
          <div class="form-group has-feedback">
          <label>Address</label>
              <textarea class="form-control" name="address"></textarea>
          </div>        
          </div> 
          </div>
          <div class="row">
          <div class="col-xs-12 col-md-10"></div>
          <div class="col-xs-12 col-md-2">
          <button type="submit"  class="btn btn-primary btn-block btn-flat">Register</button>
          </div>
          </div>  
        <br>
        <br>

  </div>
</div>

<!-- Container -->
<div id="registration_page">
  

</div>
<!-- jQuery 3 -->
</form>
<script src="{{env('base_url')}}bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{env('base_url')}}bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{env('base_url')}}plugins/iCheck/icheck.min.js"></script>
<script src="{{env('base_url')}}js/jquery.validate.min.js"></script>
<script src="{{env('base_url')}}js/style.js"></script>
<script src="{{env('base_url')}}js/jsform.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
