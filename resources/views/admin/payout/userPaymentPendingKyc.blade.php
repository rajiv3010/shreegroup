@extends('layouts.admin')
@section('title','Pending KYC')
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
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   </section>
</div>
<!-- /.box-body -->
@endsection