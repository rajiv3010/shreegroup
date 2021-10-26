@extends('layouts.admin')
@section('title','Stopped Payment')
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
          <table id="example1" class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>User ID</th>
                  <th>PAN No</th>
                  <th>Bank Name</th>
                  <th>Account No</th>
                  <th>Branch</th>
                  <th>IFSC</th>
                  <th>City</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Action</th>
              
                  
                  </tr>
              </thead>
              <tbody>
              @foreach($data as $key=>$user)
               	<tr>
                  <td>{{$key+1}}</td>
                  <td>{{$user->user->name}}</td>
                  <td>{{$user->user->user_key}}</td>
                  <td>{{$user->user->pan}}</td>
                  <td> @if($user->user->bankDetails) {{$user->user->bankDetails->name}} @else - @endif</td>
                  <td> @if($user->user->bankDetails) {{$user->user->bankDetails->account_no}} @else - @endif</td>
                  <td> @if($user->user->bankDetails) {{$user->user->bankDetails->branch}} @else - @endif</td>
                  <td> @if($user->user->bankDetails) {{$user->user->bankDetails->ifsc}} @else - @endif</td>
                  <td> @if($user->user->bankDetails) {{$user->user->bankDetails->city}} @else - @endif</td>
                  <td>{{$user->amount}}</td>
                  <td>{{$user->created_at}}</td>
                  <td>
                      <a  href="/admin/pay/user/amount/{{$user->user_key}}/{{$user->user->id}}/{{$user->amount}}/{{$user->earning}}/{{$user->id}}" onclick="return confirm('Are you sure?')">
                      <span class="mb-1 mt-1 mr-1 btn btn-sm btn-success">Pay</span></a>
                   </td>
              	</tr>
                @endforeach

              </tbody>
             
             
              </table>
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection