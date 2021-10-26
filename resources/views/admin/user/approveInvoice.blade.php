@extends('layouts.admin')
@section('title','Approve Invoice')
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
      <!-- Small boxes (Stat box) -->
      <div class="box">
         <div class="box-header">
         </div>
         @if(Session::has('message'))
         <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
         </div>
         @endif
         <a href="/admin/user/approve-invoice/1" class="btn btn-success">Under Review</a>
         <a href="/admin/user/approve-invoice/0" class="btn btn-warning">Pending</a>
         <a href="/admin/user/approve-invoice/2" class="btn btn-primary">Accepted</a>
         <a href="/admin/user/approve-invoice/3" class="btn btn-danger">Rejected</a>
         <!-- /.box-header -->
         <div class="box-body table-responsive" >
            <table id="example1" class="table table-responsive table-bordered table-striped">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Name</th>
                     <th>Invoice</th>
                     <th>Date</th>
                     <th colspan="2">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @php $i = 1 @endphp
                  @foreach($users as $user )
                  <tr>
                     <td>{{$i}}</td>
                     <td><b>{{$user->name}}</b><br>({{$user->user_key}})</td>
                     <td>
                        @if($user->signed_invoice==0)
                           Pending
                        @else
                        <img style="width: 150px;height: 100px" src="{{env('base_url')}}assets/documents/{{$user->signed_invoice_doc}}" alt="Invoice"></td>
                        @endif
                     <td>{{$user->created_at}}</td>
                     
                     <td>

                          @if($user->signed_invoice==1)
                        <a href="{{env('base_url')}}assets/documents/{{$user->signed_invoice_doc}}" class="btn btn-success btn-xs loaderPage "> View Signed Invoice</a>
                     
                        <a href="/admin/user/signed_invoice/status/{{$user->id}}/{{encrypt(3)}}" class="btn btn-danger btn-xs VerifyInvoiceWithConfirm"> Reject</a>
                     
                        <a href="/admin/user/signed_invoice/status/{{$user->id}}/{{encrypt(2)}}" class="btn btn-primary btn-xs VerifyInvoiceWithConfirm"> Verify</a>
                        @endif
                         @if($user->signed_invoice==1)
                        Uploaded at {{$user->signed_invoice_upload_at}}
                         @endif
                         @if($user->signed_invoice==2)
                           Uploaded at {{$user->signed_invoice_upload_at}}       <br>                           Accepted at {{$user->invoice_verified_at}}
                           @endif
                     </td>
                  </tr>
                  @php $i++ @endphp
                  @endforeach
               </tbody>
            </table>
         </div>
         <!-- /.box-body -->
      </div>
   </section>
   <!-- right col -->
</div>
@endsection