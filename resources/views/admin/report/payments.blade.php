@extends('layouts.admin')
@section('title','Payments')
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
            <!-- /.box-header -->
             <div class="box-body table-responsive" >
            <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>User Key</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Created</th>
                  <th>Updated</th>
                </tr>

                </tr>
                </thead>
                <tbody>
                @foreach( $payments as $key=>$payment)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$payment->user_key}}</td>
                  <td>{{$payment->amount}}</td>
                  <td>
                    @if($payment->status == 0)
                    <span class="label label-danger">Released</span>
                    @elseif($payment->status == 1)
                    <span class="label label-danger">Stopped</span>
                    @elseif($payment->status == 2)
                    <span class="label label-info">Processed</span>
                    @elseif($payment->status == 3)
                    <span class="label label-warning">Bank Process</span>
                    @elseif($payment->status == 4)
                    <span class="label label-success">Paid</span>
                    @endif
                  </td>
                  
                  <td>{{$payment->created_at}}</td>
                  <td>{{$payment->updated_at}}</td>
                </tr>
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
