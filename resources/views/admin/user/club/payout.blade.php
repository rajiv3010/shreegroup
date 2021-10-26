@extends('layouts.admin')
@section('title','Auto Pool Payouts')
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
              <a href="{{ URL::previous() }}" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a>
            </div>
             @if(Session::has('message'))
            <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
            </div>
            @endif
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Income</th>
                  <th>TDS</th>
                  <th>Admin Charge</th>
                  <th>Earned</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payouts as $key=>$value )
                <tr>
                  <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$value->created_at}}</td>
                      <td>{{$value->earning}}</td>
                      <td>{{$value->tds}}</td>
                      <td>{{$value->admin_charges}}</td>
                      <td>{{$value->amount}}</td>
                      <td>@if($value->status == 0)
                         <span class="bg-orange"> Unpaid</span>
                         @elseif($value->status == 1)
                         <span class="bg-green"> Paid</span>
                         @endif
                      </td>
                   </tr>
                  
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
