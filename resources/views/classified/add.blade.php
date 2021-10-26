@extends('layouts.app')
@section('title','Classified')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Add Classified
         <small></small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="/classified"><i class="fa fa-dashboard"></i> Classified</a></li>
         <li class="active">Add Classified</li>
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
                    @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
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
                <form role="form" action="/classified/store" method="post"  enctype="multipart/form-data">
                  {{ csrf_field ()}}
                  <!-- personal information begins -->
                  <div class="row">
                     <div class=" col-lg-12">
                     <h3 class="box-title">User Personal  Information</h3>
                     </div>
                    <div class="col-md-12" style="margin-bottom: 10px;">
                    <div class="col-md-12" style="background-color: grey;">
                       <div class=" col-lg-6 form-group">
                          <label> Package</label>
                          <select class="form-control select2"  name="package_id" id="addNew_package" style="width: 100%;">
                             <option value=""> Select Package </option>
                             @foreach($packages as $package)
                             <option value="{{$package->id}}"  @if(old("package_id") == $package->id)  selected @endif> {{$package->name}} </option>
                             @endforeach
                          </select>
                       </div>
                       <div class=" col-lg-3 form-group">
                       <label>PIN</label>
                       <select name="pin" class="form-control addNewUserPin" required="required"> 
                              
                       </select>
                     
                     </div>
                   </div>


                     <div class=" col-lg-6 form-group">
                        <label> Company/Firm Name</label>
                        <input type="text" class="form-control" value="{{old('company_name')}}" name="company_name" placeholder="Enter company name">
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label> Business Category</label>
                        <select class="form-control select2" id="business_category_id"  name="business_category_id" style="width: 100%;">
                           <option value=""> Select Category </option>
                           <option value="0"> Other </option>
                           @foreach($business_categories as $business_category)
                           <option value="{{$business_category->id}}"  @if(old("business_category_id") == $business_category->id)  selected @endif> {{$business_category->name}} | ({{count($business_category->BusinessSubCategory)}}) </option>
                           @endforeach
                        </select>
                     </div>
                       <div class=" col-lg-12">
                       <div class=" col-lg-12 form-group bg-aqua">
                        <label> Business Sub Category</label>
                        <div id="business_sub_category_id">
                        </div>
                      </div>
                     </div>
                     
                     <div class=" col-lg-6 form-group">
                        <label>State</label>
                        <select class="form-control select2" id="state_id" name="state_id">

                           <option value="">Select State</option>
                           @foreach($states as $state)
                              <option value="{{$state->id}}"  @if(old("state_id") == $state->id)   selected @endif>{{$state->name}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class=" col-lg-3 form-group">
                        <label>City</label>
                        <select class="form-control select2" value="{{old('city_id')}}" name="city_id" id="city_id">

                           <option value="">Select City/Location</option>
                        </select>
                     </div>

                     <div class=" col-lg-6 form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" value="{{old('fistname')}}" name="fistname" placeholder="Enter ..." >
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label>Last name</label>
                        <input type="text" class="form-control" value="{{old('lastname')}}" name="lastname" placeholder="Enter ..." >
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label>Mobile Number</label>
                        <input type="text" class="form-control" value="{{old('mobilenumber')}}" name="mobilenumber" placeholder="Enter ..." >
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label>Landline Number</label>
                        <input type="text" class="form-control" value="{{old('landline')}}" name="landline" placeholder="Enter ..." >
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label>Toll Free Number</label>
                        <input type="text" class="form-control" value="{{old('tollfree')}}" name="tollfree" placeholder="Enter ..."  >
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label>Email</label>
                        <input type="Email" class="form-control" value="{{old('email')}}" name="email" placeholder="Enter ..." >
                     </div>
                     <div class=" col-lg-6 form-group">
                        <label>Website</label>
                        <input type="text" class="form-control" value="{{old('website')}}" name="website" placeholder="Enter ...">
                     </div>
                      <div class="col-lg-6 form-group">
                        <label>Amenities</label>
                        <select class="form-control js-example-tokenizer" name="amenities[]" multiple="multiple">
                        </select>
                     </div>
                      <div class="col-lg-6 form-group">
                        <label>Payment Modes</label>
                        <select class="form-control js-example-tokenizer" name="paymentmodes[]" multiple="multiple">
                        @foreach($paymentmodes as $payment)
                            <option value="{{$payment->id}}">{{$payment->name}}</option>
                        @endforeach
                        </select>
                     </div>
                       <div class=" col-lg-6 form-group">
                        <label>Logo</label>
                        <input type="file" class="form-control"  name="logo">
                     </div>

                  </div>

            </div>
           <div class="box-footer">
      <div class=" col-lg-12">
      <button type="submit" class="col-lg-12 btn btn-lrg btn-info pull-right">Submit</button>
      </div>
      </div>
      </form>
      <!-- Company Information ends-->
      <!-- Other Details ends -->

</div>
</section>
</div>
<!-- /.row (main row) -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
