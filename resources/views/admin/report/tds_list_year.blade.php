@extends('layouts.admin')
@section('title','TDS')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('title')
        <small>Report</small> <a href="/admin/report/tds" class="btn btn-sm btn-info">Back</a>
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
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Year</th>
                  <th>Month</th>
                  <th>Amount</th>
                  <th>Details</th>

                </tr>
                </thead>
                <tbody>
                @foreach( $payouts as $payout)
                <tr>
                  <?php $monthNum = $payout->month;
$dateObj = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F');?>
                  <td>{{$loop->iteration}}</td>
                  <td>{{ $payout->year}}</td>
                   <td>{{ $monthName }}</td>
                  
                  <td>{{$payout->tds}}</td>
                  <td><a href="/admin/report/tds/{{$payout->year}}/{{$payout->month}}" class="btn btn-warning btn-xs"> Detail</a></td>
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
