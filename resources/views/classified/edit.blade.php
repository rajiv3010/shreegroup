@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Edit Classified
         <small>edit</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="/classified"><i class="fa fa-dashboard"></i> Classified</a></li>
         <li class="active">Edit Classified</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <section class="col-lg-12 connectedSortable">
            <!-- /.box-header -->
            <div class="box-body box box-info">
                @if(Session::has('message'))
                    <div  class="alert alert-success">
                    <p>{{Session::get('message') }}</p>
                    </div>
                    @endif

                    <div class="box-header">

            <span class="pull-left-container">
                  <small class="label pull-left bg-green"  style="margin-left: 20px;">
                    <a href="/classified/" style="text-decoration: none; color: #ffffff;">

                    <i class="fa fa-plus"></i> View Classifieds</small>
                    </a>
            </span>

            

          </div>
             <form  action="/classified/update" method="post" enctype="multipart/form-data">
                   {{ csrf_field() }}
                   <input type="hidden" name="id" value="{{$classified->id}}">
                  <!-- personal information begins -->
                  <div class="row">
                     <div class=" col-lg-12">
                     <h3 class="box-title">Personal Information</h3>
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label> Company Name</label>
                        <input type="text" class="form-control" value="{{$classified->company_name}}" name="company_name" >
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label> Business Category</label>
                        <select class="form-control select2" id="business_category_id"  name="business_category_id" style="width: 100%;">
                           <option value=""> Select Category </option>
                           @foreach($business_categories as $business_category)
                           <option @if($business_category->id == $classified->business_category_id) selected="selected" @endif value="{{$business_category->id}}">

                            {{$business_category->name}} ({{count($business_category->BusinessSubCategory)}})


                             </option>
                           @endforeach
                        </select>
                     </div>
                     <div class=" col-lg-6 form-group">
                      <label> Business Sub Category  </label>
                       <div id="business_sub_category_id">
                       </div>
                       <hr>
                       <p><strong>Selected Item :</strong></p>
                         @foreach($business_sub_categories as $csca)
                                 @if (in_array($csca->id, $subcates))
                               <input type="checkbox" name="edit_business_sub_category_id[]"  value="{{$csca->id}}" checked="checked"> {{$csca->name}}
                               @else
                               <input type="checkbox" name="edit_business_sub_category_id[]"  value="{{$csca->id}}"> {{$csca->name}}
                               @endif
                          @endforeach



                   </div>
                     <div class=" col-lg-6 form-group">
                        <label>State</label>
                        <select class="form-control select2" id="state_id" name="state_id">

                           <option value="">Select State</option>
                           @foreach($states as $state)
                              <option @if($state->id==$classified->state_id) selected="selected" @else @endif value="{{$state->id}}">{{$state->name}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class=" col-lg-3 form-group">
                        <label>City</label>
                        <select class="form-control select2"  name="city_id" id="city_id">
                           <option value="{{$classified->city->id}}">{{$classified->city->name}}</option>
                        </select>
                     </div>
                     <div class=" col-lg-3 form-group">
                        <label>Pincode</label>
                          <input type="text" class="form-control" value="{{$classified->pincode_id}}" name="pincode_id" >

                        
                     </div>

                     <div class=" col-lg-6 form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" value="{{$classified->first_name}}" name="first_name" >
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label>Last name</label>
                        <input type="text" class="form-control" value="{{$classified->last_name}}" name="last_name" >
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" value="{{$classified->mobile}}" name="mobile">
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label>Landline Number</label>
                        <input type="text" class="form-control" value="{{$classified->landline}}" name="landline" >
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label>Toll Free Number</label>
                        <input type="text" class="form-control" value="{{$classified->tollfree_number}}" name="tollfree_number">
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label>Email</label>
                        <input type="Email" class="form-control" value="{{$classified->email}}" name="email">
                     </div>
                       <div class=" col-lg-6 form-group">
                        <label>website</label>
                        <input type="text" class="form-control" value="{{$classified->website}}" name="website">
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label>description</label>
                        <input type="text" class="form-control" value="{{$classified->description}}" name="description">
                     </div>
                        <div class=" col-lg-6 form-group">
                        <label>Year of Establishment</label>
                        <input type="text" class="form-control" value="{{$classified->year_of_establishment}}" name="year_of_establishment">
                     </div>
                            <div class=" col-lg-6 form-group">
                        <label>annual_turnover</label>
                        <input type="text" class="form-control" value="{{$classified->annual_turnover}}" name="annual_turnover">
                     </div>
                    <div class=" col-lg-6 form-group">
                        <label>No Of Employee</label>
                        <input type="text" class="form-control" value="{{$classified->no_of_employee}}" name="no_of_employee">
                     </div>
                      <div class=" col-lg-6 form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="address">{{$classified->address}}</textarea>
                     </div>

                     <div class=" col-lg-6 form-group">
                        <label>Logo</label>
                        <input type="file" class="form-control"  name="logo">
                        <img src="{{$classified->logo}}" width="100" height="100">
                     </div>

            <div class=" col-lg-6 form-group">
                        <label>Profile Picture</label>
                        <input type="file" class="form-control"  name="profile_picture">
                        <img src="{{$classified->profile_picture}}" width="100" height="100">
                     </div>

                  <div class=" col-lg-6 form-group">
                        <label>Banner Image</label>
                        <input type="file" class="form-control"  name="banner_image">
                        <img src="{{$classified->banner_image}}" width="100" height="100">
                     </div>
                 <div class=" col-lg-6 form-group">
                        <label>Slider Image</label>
                        <input type="file" class="form-control"  name="slider_image[]" multiple>
                      @foreach($classifiedFiles as $classifiedFile)
                        <img src="{{$classifiedFile->file_name}}" width="100" height="100">
                        @endforeach
                     </div>
                          @php $amemities  = explode(',', $classified->amenities)  @endphp
                       <div class="col-lg-6 form-group">
                        <label>Amenities</label>
                        <select class="form-control js-example-tokenizer" name="amenities[]" multiple="multiple">
                          @foreach($amemities as $amemitie)
                          <option value="{{$amemitie}}" selected="selected">{{$amemitie}}</option>
                          @endforeach
                        </select>
                     </div>
                     @php
                      $classifiedPaymentModes = explode(',', $classified->paymentmodes)
                      @endphp
                      <div class="col-lg-6 form-group">
                        <label>Payment Modes</label>
                        <select class="form-control js-example-tokenizer" name="paymentmodes[]" multiple="multiple">
                        @foreach($paymentmodes as $payment)
                            <option value="{{$payment->id}}" @if(in_array($payment->id, $classifiedPaymentModes)) selected="selected" @else   @endif >{{$payment->name}}</option>
                        @endforeach
                        </select>
                     </div>





                  </div>
                                    <div class="row">
                    <div class="col-lg-12">
                      <h2>Hours of Operation</h2>
                          @if(count($HoursofoPerations) ==7)
                              @foreach($HoursofoPerations as $HoursofoPeration)
                              <div class="col-sm-12 col-xs-12" style="margin-bottom: 10px; padding: 0px;">
                              <div class="col-sm-4" style="float: left;">{{$HoursofoPeration->days}}</div>
                              <div class="col-sm-8" style="float: right;">
                              <input type="text" value="{{$HoursofoPeration->start_time}}"  name="{{strtolower($HoursofoPeration->days)}}start" class="timeformatExample2" /> -
                              <input type="text"  value="{{$HoursofoPeration->closing_time}}" name="{{strtolower($HoursofoPeration->days)}}end" class="timeformatExample2" />

                              </div>
                              </div>
                              @endforeach
                          @else
                         <div class="col-lg-12">
                              <div class="col-sm-12 col-xs-12" style="margin-bottom: 10px; padding: 0px;">
                          <div class="col-sm-4" style="float: left;">Monday</div>
                          <div class="col-sm-8" style="float: right;">
                          <input type="text" value="12:00:AM" name="mondaystart" class="timeformatExample2"> -
                          <input type="text" value="12:00:AM" name="mondayend" class="timeformatExample2">

                          </div>
                          </div>
                          <div class="col-sm-12 col-xs-12" style="margin-bottom: 10px; padding: 0px;">
                          <div class="col-sm-4" style="float: left;">Tuesday</div>
                          <div class="col-sm-8" style="float: right;">
                          <input type="text" value="12:00:AM" name="tuesdaystart" class="timeformatExample2"> -
                          <input type="text" value="12:00:AM" name="tuesdayend" class="timeformatExample2">

                          </div>
                          </div>
                           <div class="col-sm-12 col-xs-12" style="margin-bottom: 10px; padding: 0px;">
                          <div class="col-sm-4" style="float: left;">Wednesday</div>
                          <div class="col-sm-8" style="float: right;">
                          <input type="text" value="12:00:AM" name="wednesdaystart" class="timeformatExample2"> -
                          <input type="text" value="12:00:AM" name="wednesdayend" class="timeformatExample2">

                          </div>
                          </div>
                            <div class="col-sm-12 col-xs-12" style="margin-bottom: 10px; padding: 0px;">
                          <div class="col-sm-4" style="float: left;">Thursday</div>
                          <div class="col-sm-8" style="float: right;">
                          <input type="text" value="12:00:AM" name="thursdaystart" class="timeformatExample2"> -
                          <input type="text" value="12:00:AM" name="thursdayend" class="timeformatExample2">

                          </div>
                          </div>
                          <div class="col-sm-12 col-xs-12" style="margin-bottom: 10px; padding: 0px;">
                          <div class="col-sm-4" style="float: left;">Friday</div>
                          <div class="col-sm-8" style="float: right;">
                          <input type="text" value="12:00:AM" name="fridaystart" class="timeformatExample2"> -
                          <input type="text" value="12:00:AM" name="fridayend" class="timeformatExample2">

                          </div>
                          </div>
                          <div class="col-sm-12 col-xs-12" style="margin-bottom: 10px; padding: 0px;">
                          <div class="col-sm-4" style="float: left;">Saturday</div>
                          <div class="col-sm-8" style="float: right;">
                          <input type="text" value="12:00:AM" name="saturdaystart" class="timeformatExample2"> -
                          <input type="text" value="12:00:AM" name="saturdayend" class="timeformatExample2">

                          </div>
                          </div>
                          <div class="col-sm-12 col-xs-12" style="margin-bottom: 10px; padding: 0px;">
                          <div class="col-sm-4" style="float: left;">Sunday</div>
                          <div class="col-sm-8" style="float: right;">
                          <input type="text" value="12:00:AM" name="sundaystart" class="timeformatExample2"> -
                          <input type="text" value="12:00:AM" name="sundayend" class="timeformatExample2">

                          </div>
                          </div>
                     
                       
                        
                         
                                 
                        
                          </div>
                          @endif
                    </div>
                  </div>
                <div class="box-footer">
                <div class=" col-lg-12">
                <button type="submit" class="col-lg-12 btn btn-lrg btn-info pull-right">Update</button>
                </div>
                </div>
              </form>
            </div>

      </div>
      <!-- payment mode -->


</div>
</section>
</div>
<!-- /.row (main row) -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
