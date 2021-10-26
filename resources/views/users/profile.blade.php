@extends('layouts.user')
@section('title','User Profile')
@section('content')
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Profile</h3>
            @if ($errors->any())
            <div class="alert alert-danger">
               <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
            @endif
            @if(Session::has('message'))
            <div class="alert alert-success">
               <p>{{Session::get('message') }}</p>
            </div>
            @endif
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Personal<small> Info</small></h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div class="col-md-9">
                     <form class="form-horizontal form-label-left" novalidate  role="form" method="POST" action="/user/generalDetails" enctype="multipart/form-data">
                        @csrf
                        
                        @if(Auth::user()->package_id)
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Name</label>
                           <div class="col-sm-6">
                              <input type="text"  class="form-control" id="inputName" name="name" value="{{Auth::user()->name}}" placeholder="Name" readonly="readonly">
                           </div>
                        </div>
                        @else
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Name</label>
                           <div class="col-sm-6">
                              <input type="text"  class="form-control" id="inputName" name="name" value="{{Auth::user()->name}}" placeholder="Name">
                           </div>
                        </div>
                        @endif


                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Mobile</label>
                           <div class="col-sm-6">
                              <input type="text" name="mobile"  value="{{Auth::user()->mobile}}"  class="form-control" id="inputName" placeholder="Mobile" required="required">
                           </div>
                        </div>
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Email ID</label>
                           <div class="col-sm-6">
                              <input type="text" value="{{Auth::user()->email}}" name="email" class="form-control" id="inputName" placeholder="Email ID" required="required">
                           </div>
                        </div>
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Occupation</label>
                           <div class="col-sm-6">
                              <input type="text" value="{{Auth::user()->occupation}}" class="form-control" id="inputName" name="occupation" placeholder="Occupation" required="required">
                           </div>
                        </div>
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">DOB</label>
                           <div class="col-sm-6">
                              <input type="text" value="{{Auth::user()->dob}}" class="form-control dob" id="dob" name="dob" placeholder="DD-MM-YYYY" required="required">
                              
                           </div>
                        </div>
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">PAN</label>
                           <div class="col-sm-3">
                              <input type="text"  value="{{Auth::user()->pan}}" class="form-control" id="inputName" name="panno" required="required" placeholder="PAN">
                           </div>
                           <div class="col-sm-3">
                              <input type="file" value="{{Auth::user()->pan_documents}}" class="form-control" id="inputName"  name="pan_documents" accept="image/x-png,image/gif,image/jpeg">
                           </div>
                        </div>
                        
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Gender</label>
                           <div class="col-sm-6">
                              @if(Auth::user()->gender=="m")
                              Male
                              @else
                              Female
                              @endif
                           </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                           <div class="col-md-6 col-md-offset-3">
                              @if(Auth::user()->is_pan_verified==2)
                              <span class="label label-warning">To change details contact administrator</span>
                              @else
                              <button id="send" type="submit" class="btn btn-success">Update</button>
                              @endif
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="col-md-3">
                     <div class="x_title">
                        <h2>PAN  <small> Card</small></h2>
                        <div class="clearfix"></div>
                     </div>
                     @if(Auth::user()->pan_document)
                     <div class="col-sm-12 clearfix">
                        <img width="100%" src="{{env('base_url')}}assets/user/{{Auth::user()->id}}/documents/{{Auth::user()->pan_document}}">
                     </div>
                     <div class="col-sm-12 clearfix" style="margin-top: 20px;">
                        @if(Auth::user()->is_pan_verified==2)
                        <span class="alert-success" style="padding: 10px;">Approved</span>
                        @elseif(Auth::user()->is_pan_verified==3)
                        <span class="alert-danger" style="padding: 10px;">Rejected</span>
                        @elseif(Auth::user()->is_pan_verified==1)
                        <span class="alert-info" style="padding: 10px;"> Pending approval</span>
                        @else
                        <span class="alert-primary" style="padding: 10px;"> Yet to Upload</span>
                        @endif
                     </div>
                     @else
                     <span class="alert-primary" style="padding: 10px;">Document pending</span>
                     @endif
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Bank<small> Info</small></h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div class="col-md-9">
                     <form class="form-horizontal form-label-left" novalidate  role="form" method="POST" action="/user/bankDetails" enctype="multipart/form-data">
                        @csrf
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Payee Name</label>
                           <div class="col-sm-6">
                              <input type="text" readonly="readonly"  value="{{Auth::user()->name}}"  class="form-control" id="inputName" placeholder="Payee Name">
                           </div>
                        </div>
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Account number</label>
                           <div class="col-sm-6">
                              <input type="text" name="account_no" required="required"  value="@if(isset(Auth::user()->bankDetails->account_no)) {{Auth::user()->bankDetails->account_no}} @endif" class="form-control" id="inputName" placeholder="Account number" required="required">
                           </div>
                        </div>
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Bank Name</label>
                           <div class="col-sm-6">
                              <input type="text" name="name" required="required"   value="@if(isset(Auth::user()->bankDetails->name)) {{Auth::user()->bankDetails->name}} @endif"  class="form-control" id="inputName" placeholder="Bank Name" required="required">
                           </div>
                        </div>
                        
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">IFSC Code</label>
                           <div class="col-sm-6">
                              <input type="text" name="ifsc" required="required"   value="@if(isset(Auth::user()->bankDetails->ifsc)) {{Auth::user()->bankDetails->ifsc}} @endif" class="form-control" id="inputName" placeholder="IFSC Code" required="required">
                           </div>
                        </div>

                        <div class="item form-group">
                                 <label for="country_id" class="col-sm-3 control-label">Country <span class="required">*</span> <br><br></label>
                                 <div class="col-sm-6">
                                 <select id="country" name="country_id" value="{{ old('country_id') }}" class="form-control @error('country') is-invalid @enderror" required="required">
                                    <option value="" disabled selected>Select One</option>
                                    @foreach($countries as $country)
                                        <option @if($country->id==auth::user()->country_id) selected="selected" @endif value="{{$country->id}}"> {{$country->name}}</option>
                                    @endforeach
                                </select>
                             </div>
                              </div>

                              <div class="item form-group">
                                 <label for="state_id" class="col-sm-3 control-label">State <span class="required">*</span> <br><br></label>
                                 <div class="col-sm-6">
                                 <select id="state" name="state_id" value="{{ old('state_id') }}" class="form-control @error('state') is-invalid @enderror"  required="required">

                                    @if(auth::user()->state_id)
                                    <option value="{{ Auth::user()->state_id }}">{{auth::user()->state->name}}</option>
                                    @else
                                    <option value="">Select State/Location</option>
                                    @endif

                                    
                                </select>
                             </div>
                              </div>


                              
                              <div class="item form-group">
                                 <label for="city_id" class="col-sm-3 control-label">City <span class="required">*</span> <br><br></label>
                                 <div class="col-sm-6">
                                 <select id="city" name="city_id" value="{{ old('city_id') }}" class="form-control @error('city') is-invalid @enderror"  required="required">
                                    @if(auth::user()->city_id)
                                    <option value="{{ Auth::user()->city_id }}">{{auth::user()->city->name}}</option>
                                    @else
                                    <option value="">Select City/Location</option>
                                    @endif
                                </select>
                             </div>
                              </div>


                               <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Pin Code</label>
                           <div class="col-sm-6">
                              <input type="text" name="branch" required="required"  value="@if(isset(Auth::user()->bankDetails->branch)) {{Auth::user()->bankDetails->branch}} @endif" class="form-control" id="inputName" placeholder="Pin Code" required="required">
                           </div>
                        </div>

                               <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">SWIFT Code</label>
                           <div class="col-sm-6">
                              <input type="text" name="branch" required="required"  value="@if(isset(Auth::user()->bankDetails->branch)) {{Auth::user()->bankDetails->branch}} @endif" class="form-control" id="inputName" placeholder="SWIFT Code" required="required">
                           </div>
                        </div>
                        
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Cancelled Cheque Copy</label>
                           <div class="col-sm-6">
                              <input type="file" name="kyc_document"    class="form-control" id="inputName" placeholder="Cheque Copy" required="required" accept="image/x-png,image/gif,image/jpeg">
                           </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                           <div class="col-md-6 col-md-offset-3">
                              @if(Auth::user()->bank_kyc_status==2)
                              <span class="label label-warning">To change details contact administrator</span>
                              @else
                              <button id="send" type="submit" class="btn btn-success">Update</button>
                              @endif
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="col-md-3">
                     <div class="x_title">
                        <h2>Bank<small> KYC</small></h2>
                        <div class="clearfix"></div>
                     </div>
                     @if(isset(Auth::user()->bankDetails->kyc_document))
                     @if(Auth::user()->bankDetails->kyc_document)
                     <div class="col-sm-12 clearfix">
                        <img width="100%" src="{{env('base_url')}}assets/user/{{Auth::user()->id}}/documents/{{Auth::user()->bankDetails->kyc_document}}">
                     </div>
                     <div class="col-sm-12 clearfix" style="margin-top: 20px;">
                        @if(Auth::user()->bank_kyc_status==1)
                        <span class="alert-info" style="padding: 10px;"> Pending approval</span>
                        @elseif(Auth::user()->bank_kyc_status==2)
                        <span class="alert-success" style="padding: 10px;">Approved</span>
                        @elseif(Auth::user()->bank_kyc_status==3)
                        <span class="alert-danger" style="padding: 10px;">Rejected.Contact your referral {{auth::user()->sponsor_key}}</span>
                        @else
                        @endif
                        @else
                        <span class="alert-primary" style="padding: 10px;">KYC document pending</span>
                        @endif
                        @else
                        <span class="alert-primary" style="padding: 10px;">KYC document pending</span>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Address<small> Details</small></h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div class="col-md-9">
                     <form class="form-horizontal form-label-left" novalidate  role="form" method="POST" action="/user/update/basicinfo" enctype="multipart/form-data">
                        @csrf
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">House Number</label>
                           <div class="col-sm-6">
                              <input type="text" name="address1" class="form-control" id="inputName" value="{{Auth::user()->address1}}" placeholder="House Number" required="required">
                           </div>
                        </div>
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Building / Society Name</label>
                           <div class="col-sm-6">
                              <input type="text" name="address2" value="{{Auth::user()->address2}}"  class="form-control" id="inputName" placeholder="Building / Society Name" required="required">
                           </div>
                        </div>
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Locality</label>
                           <div class="col-sm-6">
                              <input type="text" name="address3" value="{{Auth::user()->address3}}" class="form-control" id="inputName" placeholder="Locality" required="required">
                           </div>
                        </div>
                        <div class="item form-group">
                                 <label for="country_id" class="col-sm-3 control-label">Country <span class="required">*</span> <br><br></label>
                                 <div class="col-sm-6">
                                 <select id="country" name="country_id" value="{{ old('country_id') }}" class="form-control @error('country') is-invalid @enderror" required="required">
                                    <option value="" disabled selected>Select One</option>
                                    @foreach($countries as $country)
                                        <option @if($country->id==auth::user()->country_id) selected="selected" @endif value="{{$country->id}}"> {{$country->name}}</option>
                                    @endforeach
                                </select>
                             </div>
                              </div>

                              <div class="item form-group">
                                 <label for="state_id" class="col-sm-3 control-label">State <span class="required">*</span> <br><br></label>
                                 <div class="col-sm-6">
                                 <select id="state" name="state_id" value="{{ old('state_id') }}" class="form-control @error('state') is-invalid @enderror"  required="required">

                                    @if(auth::user()->state_id)
                                    <option value="{{ Auth::user()->state_id }}">{{auth::user()->state->name}}</option>
                                    @else
                                    <option value="">Select State/Location</option>
                                    @endif

                                    
                                </select>
                             </div>
                              </div>


                              
                              <div class="item form-group">
                                 <label for="city_id" class="col-sm-3 control-label">City <span class="required">*</span> <br><br></label>
                                 <div class="col-sm-6">
                                 <select id="city" name="city_id" value="{{ old('city_id') }}" class="form-control @error('city') is-invalid @enderror"  required="required">
                                    @if(auth::user()->city_id)
                                    <option value="{{ Auth::user()->city_id }}">{{auth::user()->city->name}}</option>
                                    @else
                                    <option value="">Select City/Location</option>
                                    @endif
                                </select>
                             </div>
                              </div>
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Pincode<br><br></label>
                           <div class="col-sm-6">
                              <input type="number" name="pincode" id="pincode" value="{{Auth::user()->pincode}}" class="form-control" required="required" placeholder="Pincode">
                           </div>
                        </div>
                        <div class="item form-group">
                        <label for="inputName" class="col-sm-3 control-label">Aadhaar No. / Passport number<span class="required">*</span> <br><br></label>

                    <div class="col-sm-6">
                      <input type="text" name="aadhaar_no" id="aadhaar_no"  class="form-control"  placeholder="Aadhaar Number" value="{{Auth::user()->aadhaar_no}}">
                    </div>
                     </div>
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Aadhaar Front / Passport Front</label>
                           <div class="col-sm-6">
                              <input type="file" name="adhaar_front" value="{{Auth::user()->adhaar_front}}"  class="form-control" id="inputName" accept="image/x-png,image/gif,image/jpeg" >
                           </div>
                        </div>
                        <div class="item form-group">
                           <label for="inputName" class="col-sm-3 control-label">Aadhaar Back / Passport Back</label>
                           <div class="col-sm-6">
                              <input type="file" name="adhaar_back" value="{{Auth::user()->adhaar_back}}"  class="form-control" id="inputName" accept="image/x-png,image/gif,image/jpeg" >
                           </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                           <div class="col-md-6 col-md-offset-3">
                              @if(Auth::user()->is_adhaar_verified==2)
                              <span class="label label-warning">To change details contact administrator</span>
                              @else
                              <button id="send" type="submit" class="btn btn-success">Update</button>
                              @endif
                           </div>
                        </div>
                     </form>
                  </div>
                  <div class="col-md-3">
                     <div class="col-md-12">
                        <div class="x_title">
                           <h2>Aadhaar / Passport<small> Front</small></h2>
                           <div class="clearfix"></div>
                        </div>
                        @if(Auth::user()->adhaar_front)
                        <div class="col-sm-12 clearfix">
                           <img width="100%" src="{{env('base_url')}}assets/user/{{Auth::user()->id}}/documents/{{Auth::user()->adhaar_front}}">
                        </div>
                        @else
                        <p>Aadhaar / Passport Front Pending</p>
                        @endif
                        <div class="col-sm-12 clearfix" style="margin-top: 20px;">
                           @if(Auth::user()->is_adhaar_verified==2)
                           <span class="alert-success" style="padding: 10px;">Approved</span>
                           @elseif(Auth::user()->is_adhaar_verified==3)
                           <span class="alert-danger" style="padding: 10px;">Rejected</span>
                           @elseif(Auth::user()->is_adhaar_verified==1)
                           <span class="alert-info" style="padding: 10px;">Pending approval</span>
                           @else
                           @endif
                        </div>
                     </div>
                     <div class="col-md-12" style="margin-top: 20px;">
                        <div class="x_title">
                           <h2>Aadhaar / Passport<small> Back</small></h2>
                           <div class="clearfix"></div>
                        </div>
                        @if(Auth::user()->adhaar_back)
                        <div class="col-sm-12 clearfix">
                           <img width="100%" src="{{env('base_url')}}assets/user/{{Auth::user()->id}}/documents/{{Auth::user()->adhaar_back}}">
                        </div>
                        @else
                        <p>Aadhaar / Passport Back Pending</p>
                        @endif
                        <div class="col-sm-12 clearfix" style="margin-top: 20px;">
                           @if(Auth::user()->is_adhaar_verified==2)
                           <span class="alert-success" style="padding: 10px;">Approved</span>
                           @elseif(Auth::user()->is_adhaar_verified==3)
                           <span class="alert-danger" style="padding: 10px;">Rejected</span>
                           @elseif(Auth::user()->is_adhaar_verified==1)
                           <span class="alert-info" style="padding: 10px;">Pending approval</span>
                           @else
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Change<small> Password</small></h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <form class="form-horizontal form-label-left" novalidate  role="form" method="POST" action="/member/profile/update/password" >
                     @csrf
                     <div class="item form-group">
                        <label for="inputEmail" class="col-sm-3 control-label">New Password</label>
                        <div class="col-sm-6">
                           <input type="password" name="password" class="form-control" id="inputEmail" placeholder="New Password">
                        </div>
                     </div>
                     <div class="item form-group">
                        <label for="inputEmail" class="col-sm-3 control-label">Confirm New Password</label>
                        <div class="col-sm-6">
                           <input type="password" name="password_confirmation" class="form-control" id="inputEmail" placeholder="Confirm New Password">
                        </div>
                     </div>
                     <div class="ln_solid"></div>
                     <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                           <button id="send" type="submit" class="btn btn-success">Update</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
      
      <div class="clearfix"></div>
   </div>
   <div class="clearfix"></div>
</div>
@endsection