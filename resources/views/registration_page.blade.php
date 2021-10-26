
<div class="registration_details">
  <link rel="stylesheet" href="{{env('base_url')}}plugins/daterangepicker/daterangepicker.css">  
  <link rel="stylesheet" href="{{env('base_url')}}plugins/datepicker/datepicker3.css">

      <div class="container" id="personal_info">
          <div class="row">
               <div class="col-lg-12">
                      <div class="messageDiv" style="display: none">
                          <div class="message"></div>
                    </div>
               </div>
             </div>
          <div class="login-box-body">
              <h3 class="login-box-msg">Sponser Details</h3>
            
              <div class="row">
                <div class="col-md-6">
                  <label>User name : </label>
                  <span>{{$userData->name}}</span>
                </div>
                <div class="col-md-6">
                  <label>Sponser id : </label>
                  <span>{{$userData->user_key}}</span>
                </div>
                <div class="col-md-6">
                  <label>Package Name : </label>
                  <span>{{$package->name}}</span>
                </div>
                <div class="col-md-6">
                  <label>PIN : </label>
                  <span>{{$pin}}</span>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                      <label>Leg</label>
                      <div class="radio">
                          <label>
                          <input type="radio" name="placement" id="placement" value="0" checked>
                          Left
                          </label>
                          <label>
                          <input type="radio" name="placement" id="placement" value="1">
                          Right
                          </label>
                      </div>
                    </div>     
                </div>  
              </div> 
          </div>
      </div>
      <!-- Container -->
<br>


        <!-- /.login-logo -->
      <div class="container" id="personal_info">
          <div class="login-box-body">
              <h3 class="login-box-msg">Personal Info</h3>

              {{ csrf_field() }}
              <div class="row">
              <div class="col-md-6 col-md-offset-3">
              <div class="form-group has-feedback">
              <label>Sponser ID</label>
              <input type="text" name="sponsor_key" id="sponsor_key"  class="form-control" placeholder="Enter your full name as per bank account">
              </div>
              </div>

              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Full name</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Enter your full name as per bank account">
              <input type="hidden" name="user_name" id="user_name" class="form-control" value="{{$userData->name}}">
              <input type="hidden" name="user_key" id="user_key" class="form-control" value="{{$userData->user_key}}">
              <input type="hidden" name="package_name" id="package_name" class="form-control" value="{{$package->name}}">
              <input type="hidden" name="pin" id="pin" class="form-control" value="{{$pin}}">
              </div>        
              </div> 

              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Mobile Number</label>
              <input type="number" name="mobile"  value="1234567890" class="form-control" placeholder="Mobile">
              </div>        
              </div> 
              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Secondary Mobile Number</label>
              <input type="number" name="mobile1" value="1234567890" class="form-control" placeholder="Mobile">
              </div>        
              </div> 
              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Email id</label>
              <input type="email" name="email" class="form-control" placeholder="Enter your email id">
              </div>        
              </div> 
              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Password</label>
              <input type="password" name="password"  value="123456" class="form-control" placeholder="Enter your password">
              </div>        
              </div> 
              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Occupation</label>
              <select class="form-control" name="occupation">
              <option value="" selected="selected">Select Occupation</option>               
              <option selected="selected" value="Service">Service</option>
              <option value="Farmer">Farmer</option>
              <option value="Officer/Executive-Senior">Officer/Executive-Senior</option>
              <option value="Officer/Executive-Middle">Officer/Executive-Middle</option>
              <option value="Officer/Executive-Junior">Officer/Executive-Junior</option>
              <option value="Software Professional">Software Professional</option>
              <option value="Supervisor">Supervisor</option>
              <option value="Clerical/Salesperson">Clerical/Salesperson</option>
              <option value="Self Employed Professional">Self Employed Professional</option>
              <option value="Businessman">Businessman</option>
              <option value="Shopowner">Shopowner</option>
              <option value="Worker">Worker</option>
              <option value="Student" selected="">Student</option>
              <option value="Not working/Retired">Not working/Retired</option>
              <option value="Housewife">Housewife</option>
              <option value="Others">Others</option>
              </select>
              </div>        
              </div>
              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>PAN number -1</label>
              <input type="text" name="panno" id="pan"  class="form-control" placeholder="Enter your PAN number">
              </div>        
              </div> 

              <div class="form-group col-lg-6">
              <label>Date of Birth</label>
              <div class="input-group date">
              <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
              </div>
                <input type="text" readonly="readonly"  id="dob"  name="dob"  class="dob form-control pull-right">

              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Gender</label>
              <div class="radio">
              <label>
              <input type="radio" checked="checked" name="gender" id="optionsRadios1" value="m" checked>
              Male
              </label>
              <label>
              <input type="radio" name="gender" id="optionsRadios2" value="f">
              Female
              </label>
              </div>
              </div>     
              </div>

              </div>
          </div>
      </div>
    
      <div class="container" id="bank_info">
      <div class="login-box-body">
      <div class="row">

      <div class="col-xs-12 col-md-12">
         <div class="messageDiv" style="display: none">
        <div class="message"></div>
      </div>
      </div>
      <div class="col-xs-12 col-md-2">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Preview</button>
      </div>
      </div>
      </div>
      </div>
      <!-- Container -->
      <!-- /.login-box -->
</div>
<script src="{{env('base_url')}}bower_components/jquery/dist/jquery.min.js"></script>
<script src="{{env('base_url')}}bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{env('base_url')}}plugins/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
var dt = new Date();
dt.setFullYear(new Date().getFullYear()-18);
  $(".dob").datepicker({
        viewMode: "years",
        endDate : dt
});
</script>