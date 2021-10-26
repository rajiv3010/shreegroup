@extends('layouts.admin')
@section('title','Release Payment')
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
      <div class="box">
         <!-- /.box-header -->
         <div class="box-body table-responsive" >
         <a href="/admin/payment/release/forBank" class="btn btn-success" style="margin-bottom: 10px;">Generate Report For Bank</a>
            <table  class="table table-responsive table-bordered table-striped">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>Name</th>
                     <th>ID</th>
                     <th>PAN No</th>
                     <th>Bank Name</th>
                     <th>Account No</th>
                     <th>Branch</th>
                     <th>IFSC</th>
                     <th>City</th>
                     <th>Amount</th>
                  </tr>
               </thead>
               <tbody>
                  @php $i = 1;$total=0 @endphp
                  @foreach($data as $value)
                  @if(isset($value->userByKey->name))
                  <tr>
                     <td>{{$i}}</td>
                     <td>{{$value->userByKey->name}}</td>
                     <td>{{$value->userByKey->user_key}}</td>
                     <td>{{$value->userByKey->pan}}</td>
                     <td> @if($value->userByKey->bankDetails) {{$value->userByKey->bankDetails->name}} @else - @endif</td>
                     <td> @if($value->userByKey->bankDetails) {{$value->userByKey->bankDetails->account_no}} @else - @endif</td>
                     <td> @if($value->userByKey->bankDetails) {{$value->userByKey->bankDetails->branch}} @else - @endif</td>
                     <td> @if($value->userByKey->bankDetails) {{$value->userByKey->bankDetails->ifsc}} @else - @endif</td>
                     <td> @if($value->userByKey->bankDetails) {{$value->userByKey->bankDetails->city}} @else - @endif</td>
                     <td>{{$value->amount}}</td>
                  </tr>
                  @endif
                  @php $i++; $total += $value->amount @endphp
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
                     <th>{{$total}}</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   </section>
</div>
<!-- /.box-body -->
@endsection