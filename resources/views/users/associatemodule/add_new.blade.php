@extends('layouts.user')
@section('title','Add New Member')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Add New Member</h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Registration <small> Form</small></h2>
                  <div class="clearfix"></div>
               </div>
               @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               <div class="x_content">
                  <form class="form-horizontal form-label-left" novalidate  role="form" method="POST" action="/member/add-new/save" enctype="multipart/form-data">
                     @csrf

                     <span id="parent_name"></span>
                     <span class="section">Member Info</span>
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Referral ID  <span class="required">*</span>
                        </label>
                        @if($request->key==null)
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" id="sponsor_key" name="sponsor_key"  value="{{ Auth::user()->user_key}}"  class="form-control col-md-7 col-xs-12">
                        </div>
                        <input type="hidden" name="is_from_tree" value="0">
                        @else
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="sponsor_key" value="{{$request->key}}" class="form-control col-md-7 col-xs-12">
                        </div>
                        <input type="hidden" name="is_from_tree" value="1">
                        @endif
                     </div>
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Placement ID <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input class="form-control col-md-7 col-xs-12" id="parent_key"  name="parent_key" placeholder="Enter Placement ID" type="text" value="{{ Auth::user()->user_key}}">
                        </div>
                     
                     </div>
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">User name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input class="form-control col-md-7 col-xs-12"  id="user_name"  name="user_name" placeholder="Enter user name" type="text" value="{{ old('user_name') }}">
                           <div class="user_name_search"></div>
                        </div>
                     </div>
                     
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">* (as per bank account details)</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="name" class="form-control col-md-7 col-xs-12"   name="name" placeholder="Enter your full name as per bank account" type="text" value="{{ old('name') }}">
                        </div>
                     </div>
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="email" id="email"  name="email"  class="form-control col-md-7 col-xs-12" placeholder="Email" value="{{ old('email') }}">
                        </div>
                     </div>
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input type="number" id="number"  name="mobile"  class="form-control col-md-7 col-xs-12" placeholder="Number" value="{{ old('mobile') }}">
                        </div>
                     </div>
                     
                     <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Password <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <input id="password" type="password"  name="password"  class="form-control col-md-7 col-xs-12" value="{{ old('password') }}">
                        </div>
                     </div>
                    
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dob">Gender
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                           <label>
                           <input type="radio"   name="gender" id="optionsRadios1" value="m"  checked="true" >
                           Male
                           </label>
                           <label>
                           <input type="radio" name="gender" id="optionsRadios2" value="f">
                           Female
                           </label>
                        </div>
                     </div>

                     
                     <hr>
                     
                     
                    
                     <div class="ln_solid"></div>
                     <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                           <button id="addUser" type="submit" class="btn btn-success"  onclick="return confirm('Are you sure?')">Submit</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /page content -->
@endsection