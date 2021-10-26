@extends('layouts.admin')
@section('title','User Payment')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h2 class="card-title">@yield('title') <small><a href="/admin/user-payment/pending-kyc"  class="btn btn-xs btn-primary">Pending KYC</a></small></h2>
      <ol class="breadcrumb">
         <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- /.row 1 - small boxes -->
      @if(Session::has('message'))
      <div class="alert alert-success">
         <p>{{Session::get('message') }}</p>
      </div>
      @endif
      <div class="box">
         <!-- /.box-header -->
         <div class="box-body table-responsive" >
            <table id="example1" class="table table-responsive table-bordered table-striped">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Income Type</th>
                     <th>User Name</th>
                     <th>ID</th>
                     <th>Total Earning</th>
                     <th>TDS</th>
                     <th>Admin Charges</th>
                     <th>Payable</th>
                     <th>Date</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($payouts as $key=>$data)
                  <tr>
                     <td>{{$key+1}}</td>
                     <td>{{$data->businessarea->area_name}} </td>
                     <td>{{$data->user->name}} </td>
                     <td>{{$data->user->user_key}}</td>
                     <td>
                        <b>{{$data->earning}}</b>
                     </td>
                     <td>
                        <b>{{$data->tds}}</b>
                     </td>
                     <td>
                        <b>{{$data->admin_charges}}</b>
                     </td>
                     
                     <td>
                        <b>{{$data->amount}}</b>
                     </td>
                     <td>{{$data->created_at}}</td>
                     <td>
                        @if($data->user->bank_kyc_status == 2)
                        <a  href="/admin/pay/user/amount/{{$data->user_key}}/{{$data->user->id}}/{{$data->amount}}/{{$data->earning}}/{{$data->id}}" onclick="return confirm('Are you sure?')">
                        <span class="mb-1 mt-1 mr-1 btn btn-sm btn-success">Pay</span>
                        </a>
                        @else
                        <span class="mb-1 mt-1 mr-1 btn btn-sm btn-info">Pending</span>
                        @endif
                        <a  href="/admin/user/amount/status/{{$data->user->user_key}}/{{$data->user->id}}/{{$data->amount}}/{{$data->id}}/3">
                        <span class="mb-1 mt-1 mr-1 btn btn-sm btn-danger"> Stop</span>
                        </a>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
               <thead>
                  <tr>
                     <th>&nbsp;&nbsp;</th>
                     <th>&nbsp;&nbsp;</th>
                     <th>&nbsp;&nbsp;</th>
                     <th>&nbsp;&nbsp;</th>
                     <th>&nbsp;&nbsp;</th>
                     <th>&nbsp;&nbsp;</th>
                     <th>&nbsp;&nbsp;</th>
                     <th>&nbsp;&nbsp;</th>
                     <th>&nbsp;&nbsp;</th>
                     <th>&nbsp;&nbsp;</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   </section>
</div>
<!-- /.box-body -->
@endsection