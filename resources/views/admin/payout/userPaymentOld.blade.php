@extends('layouts.admin')
@section('title','Old Payment')
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
                  <th>User Name</th>
                  <th>ID</th>
                  <th>Amount</th>
                  <th>Status</th>
                  
                  
                  </tr>
              </thead>
              <tbody>
                @php $i = 1 @endphp
             @foreach($payouts as $data)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$data->user->name}} </td>
                  <td>{{$data->user->user_key}}</td>
                  <td>
                    @php $sum = 0 @endphp
                    {{$data->businessarea->lable}}
                    <span class="pull-right badge {{$data->businessarea->bg_color}}">{{$data->total}}</span>
                  </td>
                  <td>
                      <a  href="/admin/user/amount/status/{{$data->user->user_key}}/{{$data->user->id}}/{{$data->total}}/2/0">
                      <span class="badge bg-red pull-right"> Stop</span>
                      </a>
                      <a  href="/admin/pay/user/amountold/{{$data->user_key}}/{{$data->user->id}}/{{$data->total}}" onclick="return confirm('Are you sure?')">
                      <span class="pull-right badge bg-green">Pay</span>
                      </a>
                    
                  </td>
                </tr>
                @php $i++ @endphp
                @endforeach

              </tbody>
             
             
              </table>
          </div>
            
       </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection