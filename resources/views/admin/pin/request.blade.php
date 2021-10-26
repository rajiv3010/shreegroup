@extends('layouts.admin')
@section('title','Pin Request')
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
            <a href="/admin/pin/request/accepted" class="btn btn-success btn-xs">Accepted</a>
            <a href="/admin/pin/request" class="btn btn-info btn-xs">New Request</a>
         </div>
         @if(Session::has('message'))
         <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
         </div>
         @endif
         <!-- /.box-header -->
         <div class="box-body table-responsive" >
            <table id="example1" class="table table-responsive table-bordered table-striped">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>User</th>
                     <th>Pin Quantity</th>
                     <th>Package</th>
                     <th>Payment Mode</th>
                     <th>Reference Number</th>
                     <th>Transfered To Bank</th>
                     <th>Receipt</th>
                     <th>Provider Bank</th>
                     <th>Payment Date</th>
                     <th>Payment Time</th>
                     <th>Request Date</th>
                     <th>Status</th>
                     <th colspan="2">Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($PinRequests as $key=>$PinRequest)

                  <tr>
                     <td>{{$key+1}}</td>
                     <td>{{$PinRequest->user->name}}<br>({{$PinRequest->user->user_key}})</td>
                     <td>{{$PinRequest->qty}}</td>
                     <td>{{$PinRequest->package->name}}<br>
                        ₹ {{$PinRequest->package->amount}}</td>
                     <td>{{$PinRequest->payment_mode}}</td>
                     <td>{{$PinRequest->reference_number}}</td>
                     <td>{{$PinRequest->bank}}</td>
                     <td>
                        <a  data-lightbox="{{env('base_url')}}documentation/pinRequestReceipt/{{$PinRequest->upload_receipt}}" href="{{env('base_url')}}documentation/pinRequestReceipt/{{$PinRequest->upload_receipt}}" class="example-image-link">      
                        <img width="100" height="auto" src="{{env('base_url')}}documentation/pinRequestReceipt/{{$PinRequest->upload_receipt}}">
                        </a>
                     </td>
                     <td>{{$PinRequest->provider_bank}}</td>
                     <td>{{$PinRequest->request_date}}</td>
                     <td>{{$PinRequest->request_time}}</td>

                     <td>{{$PinRequest->created_at}}</td>
                     <td>@if($PinRequest->status==0)
                                            <span class="label label-danger"> Pending </span>
                                          @elseif($PinRequest->status==1)
                                            <span class="label label-success"> Approved</span>
                                          @elseif($PinRequest->status==2)
                                          <span class="label label-danger"> Rejected</span>
                                          @else
                                          <span class="label label-danger"> Pending</span>
                                          @endif</td>

                     <td>
                     @if($PinRequest->status==1)
                        <a href="/admin/pin/request/details/{{$PinRequest->id}}" class="loaderPage">Details</a>
                        @else
                        <a href="/admin/pin/request/status-change/{{$PinRequest->id}}/1" class="btn btn-success btn-xs loaderPage"> Approve</a>

                        @endif
                     </td>
                     <td>
                        @if($PinRequest->status==2 || $PinRequest->status==1)
                        
                        @else

                        <a href="/admin/pin/request/status-change/{{$PinRequest->id}}/2" class="btn btn-danger btn-xs loaderPage"> Reject</a>
                     
                        @endif
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            {{ $PinRequests->links() }}
         </div>
         <!-- /.box-body -->
      </div>
   </section>
   <!-- right col -->
</div>
@endsection