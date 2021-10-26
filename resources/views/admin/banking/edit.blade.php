@extends('layouts.admin')
@section('title','Banking - Edit')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">

   	  @if(Session::has('message'))
            <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
            </div>
            @endif
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
      

         <form role="form"  action="/admin/banking/{{$banking->id}}" class="form-horizontal" method="post"  enctype="multipart/form-data" >
            {{ csrf_field() }}
            <div class="box-body">
               <input name="_method" type="hidden" value="PATCH">
               <input type="hidden" value="{{csrf_token()}}" name="_token" />
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Company Name</label>
                     <input type="text" class="form-control" name="company_name" value="{{$banking->company_name}}"  placeholder="Company Name">
                  </div>
               </div>

               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Bank Name</label>
                     <input type="text" class="form-control" name="bank_name" value="{{$banking->bank_name}}"  placeholder="Bank Name">
                  </div>
               </div>
               
              
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Account Number</label>
                     <input type="number" class="form-control" name="account_number" value="{{$banking->account_number}}"  placeholder="Account Number">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">Branch Name</label>
                     <input type="text" class="form-control" name="branch_name" value="{{$banking->branch_name}}"  placeholder="Branch Name">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group col-md-12">
                     <label  class="control-label">IFSC</label>
                     <input type="text" class="form-control" name="ifsc" value="{{$banking->ifsc}}" placeholder="IFSC">
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