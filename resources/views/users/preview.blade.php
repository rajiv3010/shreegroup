<form class="login-form" id="Userregistration" role="form" method="POST" action="/register">
    <h1 align="center">Confirm Your Details</h1>
<div class="registration_details">
      <div class="container" id="personal_info">
          <div class="login-box-body">
              <h3 class="login-box-msg">Sponser Details</h3>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group has-feedback">
                      <label>Leg</label>
                      <input type="hidden" name="placement" value="{{$preview['placement']}}">
                      @if($preview['placement'] ==0)
                          Left
                      @else
                          Right
                      @endif
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
              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Full name</label>
              <input readonly="readonly" type="text"  name="name" value="{{$preview['name']}}" id="name" class="form-control">
              <input readonly="readonly" type="hidden" name="sponsor_key" value="{{$preview['sponsor_key']}}" id="sponsor_key" class="form-control">
              </div>        
              </div> 

              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Mobile Number</label>
              <input readonly="readonly" type="number" name="mobile"  value="{{$preview['mobile']}}" class="form-control" placeholder="Mobile">
              </div>        
              </div> 
              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Secondary Mobile Number</label>
              <input readonly="readonly" type="number" name="mobile1" value="{{$preview['mobile1']}}" class="form-control">
              </div>        
              </div> 
              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Email id</label>
              <input readonly="readonly" type="email" name="email" value="{{$preview['email']}}" class="form-control">
              </div>        
              </div> 
              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Password</label>
              <input readonly="readonly" type="password" name="password"  value="{{$preview['password']}}" class="form-control" >
              </div>        
              </div> 
              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Occupation</label>
               <input type="text" class="form-control" name="occupation" value="{{$preview['occupation']}}" >
              </div>        
              </div>
              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>PAN number</label>
              <input readonly="readonly" type="text" name="panno" value="{{$preview['panno']}}" class="form-control">
              </div>        
              </div> 


              <div class="col-md-6">
              <div class="form-group has-feedback">
              <label>Gender</label>
                  @if($preview['gender']=='m')
                      Male
                  @else
                      Female
                  @endif
                <input  name="gender" type="hidden" value="{{$preview['gender']}}" class="form-control">
              </div>     
              </div>

              </div>
          </div>
      </div>
      <div class="container" id="bank_info">
      <div class="login-box-body">
      <div class="row">
      <div class="col-xs-12 col-md-10"></div>
      <div class="col-xs-12 col-md-2">
      <button type="button" class="btn resetDetails btn-primary btn-block btn-left">Reset</button>
      <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
      </div>
      </div>
      </div>
      </div>
      <!-- Container -->
      <!-- /.login-box -->
</div>
</form>