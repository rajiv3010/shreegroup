@extends('layouts.admin')
@section('title','User Profile Edit')
@section('content')

<div class="content-wrapper" style="min-height: 1170px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('title')
      </h1>
      <ol class="breadcrumb">
         <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')</li>
      </ol>
  
       @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <form action="/admin/user/changeProfile_photo" method="post" enctype="multipart/form-data"  id="profileForm">
                {{csrf_field() }}
                <input type="hidden" name="user_id" value="{{$user->id}}">
                  <input style="display: none" type="file" name="profile_photo" id="profile_photo">

                </form>

                        @if($user->profile_photo)
                        <img title="Click here to chnage photo" accept="image/*"  src="{{env('base_url')}}assets/user/{{$user->id}}/profile/{{$user->profile_photo}}" class="changeProfile_photo profile-user-img img-responsive img-circle" alt="User Image" title="Click here to change photo"> @else @if($user->gender == "m")
                        <img title="Click here to chnage photo" accept="image/*" src="{{env('base_url')}}dist/img/avatar5.png" class="changeProfile_photo profile-user-img img-responsive img-circle" alt="{{$user->name}}" title="Click here to change photo"> @else
                        <img title="Click here to chnage photo" accept="image/*" src="{{env('base_url')}}dist/img/avatar3.png" class="changeProfile_photo profile-user-img img-responsive img-circle" title="Click here to change photo" alt="{{$user->name}}"> @endif @endif
                <div class="loading" style="display: none;">
                  <i class="fa fa-spinner fa-pulse fa-2x fa-fw" style="margin-left: 104px;top: -54px;position: relative;"></i>
                  <span class="sr-only">Loading...</span>
                </div>
              <h3 class="profile-username text-center">{{$user->name}}</h3>

              <p class="text-muted text-center">{{$user->user_key}}</p>
                @if(Session::has('message'))
                  <div class="alert alert-success">
                  <p>{{Session::get('message') }}</p>
                 </div>
            @endif

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Tag</b> <a class="pull-right">Associate</a>
                </li>
                <li class="list-group-item">
                  <b>Sponser ID</b> <a class="pull-right">{{$user->sponsor_key}}</a>
                </li>
                <li class="list-group-item">
                  <b>Sponsor Name</b> <a class="pull-right">{{$user->sponsor_key}}</a>
                </li>
                @if($addedBy['created_by']=="APC")
                <li class="list-group-item">
                  <b>APC ID 
                  </b> <a class="pull-right">{{$addedBy['apc_key']}}</a>
                </li>
                <li class="list-group-item">
                  <b>APC Name</b> <a class="pull-right">{{$addedBy['apc_name']}}</a>
                </li>
                  @endif
                <li class="list-group-item">
                  <b>Package Name
                  </b>
                  @if(isset($user->package_id))
                      @if($user->package_id)
                   <a class="pull-right"  target="_blank">{{$user->package->name}}</a>  
                   @endif
                   @else
                   NA
                   @endif
            
                </li>
                <li class="list-group-item">
                  <b>Eligible</b> <a class="pull-right"  target="_blank">@if($user->is_eligible) Yes  @else No @endif</a>
                </li>

                <!-- <li class="list-group-item">
                  <b>Invoice</b> <a class="pull-right" href="/invoice" target="_blank">Show</a>
                </li> -->

              </ul>

              <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">General</a></li>
              <li><a href="#timeline" data-toggle="tab">Bank Details</a></li>
              <li><a href="#address" data-toggle="tab">Address</a></li>
              <li><a href="#settings" data-toggle="tab">Password</a></li>
              @if(isset($user->package->id))
              @if($user->package->id == 300)
              <li><a href="#upgradePackage" data-toggle="tab">Upgrade Package</a></li>
              
              @else
              @endif
              @endif
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <!-- Post -->

                   <form role="form" action="/admin/user/generalDetails" method="post">
                    {{csrf_field() }}
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="box-body">
                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">Name</label>

                    <div class="col-sm-9">
                      <input type="text"  class="form-control" name="name" id="inputName" value="{{$user->name}}" placeholder="Name">
                    </div>
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">Mobile</label>

                    <div class="col-sm-9">
                      <input type="number"  value="{{$user->mobile}}" name="mobile" class="form-control" id="inputName" placeholder="Mobile">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">Mobile 1</label>

                    <div class="col-sm-9">
                      <input type="number" value="{{$user->mobile1}}" name="mobile1" class="form-control" id="inputName" placeholder="Mobile 1">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">Email ID</label>

                    <div class="col-sm-9">
                      <input type="text"  value="{{$user->email}}" name="email" class="form-control" id="inputName" placeholder="Email-ID">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">Occupation</label>

                    <div class="col-sm-9">
                      <input type="text" value="{{$user->occupation}}" class="form-control" id="inputName" name="occupation">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">PAN</label>

                    <div class="col-sm-9">
                      <input type="text"  value="{{$user->pan}}" name="pan" class="form-control" id="inputName" placeholder="PAN">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">Date of Birth</label>

                    <div class="col-sm-9">
                      <input type="text"  value="{{$user->dob}}" class="form-control dob" id="dob" placeholder="DOB" name="dob">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">Gender</label>

                    <div class="col-sm-9">
                      <label>Male</label>
                      <input type="radio" name="gender" value="m" @if($user->gender=="m")
                          checked="checked"
                      @endif>
                      <label>Female</label>
                      <input type="radio" name="gender" value="f" @if($user->gender=="f")
                          checked="checked"
                      @endif>
                    </div>
                  </div>





                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </div>
                </form>

                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                   <form role="form" action="/admin/user/bankDetails" method="post">
                    {{csrf_field() }}
                    <input type="hidden" name="user_key" value="{{$user->user_key}}">
                    <div class="box-body">
                  <div class="form-group col-sm-6">
                    <label for="payee_name" class="col-sm-3 control-label">Payee Name</label>

                    <div class="col-sm-9">
                      <input type="text"   value="{{$user->name}}"  class="form-control" id="payee_name" placeholder="Payee Name">
                    </div>
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="account_no" class="col-sm-3 control-label">Account Number</label>

                    <div class="col-sm-9">
                      <input type="text" name="account_no"  value="@if(isset($user->bankDetails->account_no)) {{$user->bankDetails->account_no}}@endif"  class="form-control"  placeholder="Bank Name">
                    </div>
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="name" class="col-sm-3 control-label">Bank Name</label>

                    <div class="col-sm-9">
                      <input type="text" name="name"  value="@if(isset($user->bankDetails->name)) {{$user->bankDetails->name}}@endif"  class="form-control"  placeholder="Bank Name">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="branch" class="col-sm-3 control-label">Branch Name</label>

                    <div class="col-sm-9">
                      <input type="text" name="branch" value="@if(isset($user->bankDetails->branch)) {{$user->bankDetails->branch}}@endif" class="form-control" id="branch" placeholder="Branch Name">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="ifsc" class="col-sm-3 control-label">IFSC Code</label>

                    <div class="col-sm-9">
                      <input type="text" name="ifsc"  value="@if(isset($user->bankDetails->ifsc)) {{$user->bankDetails->ifsc}}@endif" class="form-control" id="ifsc" placeholder="IFSC Code">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="city" class="col-sm-3 control-label">City</label>
                      <div class="col-sm-9">
                      <input type="text" name="city"  value="@if(isset($user->bankDetails->city)) {{$user->bankDetails->city}}@endif" class="form-control" id="city" placeholder="City">
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="address">
                <!-- Post -->

                   <form role="form" action="/admin/user/update/basicinfo" method="post">
 {{csrf_field() }}
 <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="box-body">
                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input type="text" name="address1" class="form-control" id="inputName" value="{{$user->address1}}" placeholder="House Number">
                    </div>
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">Address</label>

                    <div class="col-sm-9">
                      <input type="text" name="address2" value="{{$user->address2}}"  class="form-control" id="inputName" placeholder=" House Name / Building Name">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">Locality</label>

                    <div class="col-sm-9">
                      <input type="text" name="address3" value="{{$user->address3}}" class="form-control" id="inputName" placeholder="Locality">
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">State<br><br></label>

                    <div class="col-sm-9">
                      <select class="form-control select2" id="state_id" name="state_id">

                           <option value="">Select State</option>
                           @foreach($states as $state)
                              <option @if($state->id==$user->state) selected="selected" @endif value="{{$state->id}}">{{$state->name}}</option>
                           @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">City<br><br></label>

                    <div class="col-sm-9">
                      <select class="form-control select2" id="city_id" name="city_id">

                         @if($user->city)
                           <option value="">{{$user->city_name->name}}</option>
                         @else
                           <option value="">Select City/Location</option>
                         @endif

                        </select>
                    </div>
                  </div>
                  <div class="form-group col-sm-6">
                    <label for="inputName" class="col-sm-3 control-label">Pincode<br><br></label>

                    <div class="col-sm-9">
                      <input type="text" name="pincode" id="pincode" value="{{$user->pincode}}" class="form-control" placeholder="Pincode">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </div>
                </form>

                <!-- /.post -->
              </div>

              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal" action="/admin/user/password-update" method="post"
                    >
                    {{csrf_field()}}
                   <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">New Password</label>

                    <div class="col-sm-10">
                      <input type="password" name="password" class="form-control" id="inputEmail" placeholder="New Password">
                      <input type="hidden" name="user_id"  value="{{$user->id}}">
                    </div>

                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Confirm New Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="password_confirmation" class="form-control" id="inputEmail" placeholder="Confirm New Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              

              <div class="tab-pane" id="upgradePackage">
                <form class="form-horizontal" action="/admin/user/upgrade/package" method="post">
                    {{ csrf_field() }}

                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Package</label>

                    <div class="col-sm-10">
                        <select name="package_id" class="form-control">
                          @foreach($packages as $package)
                              <option value="{{$package->id}}">{{$package->name}}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">PIN</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="pin" id="inputName" placeholder="PIN">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Upgrade</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
    @endsection
