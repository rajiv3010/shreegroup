@extends('layouts.admin')
@section('title','Edit Package')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         @yield('title')
      </h1>
      <ol class="breadcrumb">
         <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- /.row 1 - small boxes -->
      <!-- form -->
      <div class="box box-primary">
         <!-- /.box-header -->
         <!-- form start -->
         <form role="form"  action="/admin/package/update" class="form-horizontal" method="post"  enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="box-body">
                <div class="col-md-6" >
                  <div class="form-group col-md-12">
                     <label  class="control-label">Property Package Type {{$package->package_type_id}}</label>
                     <select class="form-control" name="package_type_id">
                        @foreach($PackageType as $value)
                        <option value="{{$value->id}}" @if($package->package_type_id==$value->id) selected="selected" @endif>{{$value->name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>


               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Name</label>
                     <input type="text" class="form-control" name="name" value="{{$package->name}}"  placeholder="Name">
                     <input type="hidden" class="form-control" name="id" value="{{$package->id}}"  placeholder="Name">
                  </div>
               </div>
               <div class="col-md-6" style="display: none;" >
                  <div class="form-group col-md-12">
                     <label  class="control-label">Business Area</label>
                     <select class="form-control" name="business_area_id">
                        <option>Select Area</option>
                        @foreach($business_areas as $business_area)
                        <option value="{{$business_area->id}}" @if($package->business_area_id==$business_area->id) selected="selected" @endif>{{$business_area->area_name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Package Amount</label>
                     <input type="text" class="form-control" name="amount" value="{{$package->amount}}"  placeholder="Amount">
                  </div>
               </div>
               
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Instant ROI (%)</label>
                     <input type="text" class="form-control" name="direct_income" value="{{$package->direct_income}}"  placeholder="Direct Income">
                  </div>
               </div>
            
               <!-- Level Select -->
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Upto Level</label>
                     <input type="number" class="form-control" name="level_limit" max="20"  value="{{$package->level_limit}}" placeholder="Must be set according to package">
                  </div>
               </div>
               
               
             
               

            </div>
            <div class="box-footer">
               <button type="submit" class="btn btn-primary">Update</button>
            </div>
            <!-- /.box-body -->
         </form>
      </div>

      <!-- form -->
      <!-- list start -->
   
      </section>
      <!-- list start -->
</div>

   
   <!-- /.box-body -->
@endsection