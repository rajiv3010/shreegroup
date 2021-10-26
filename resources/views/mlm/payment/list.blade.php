@extends('layouts.mlm')
@section('title','Dashboard')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Payout
  <small></small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="/payout"><i class="fa fa-dashboard"></i> Payout</a></li>
  <li class="active">All Payout</li>
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
                  <th>Date</th>
                  <th>Amount Payable</th>
                  <th>Status</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($payouts as $payout)
                <tr>
                    <td>{{date('Y-m-d',strtotime($payout['created_at']))}}</td>
                    <td>{{$payout['amount']}}</td>
                    <td>@if($payout['status'] ==0)
                              paid
                        @else
                          Pending
                      @endif
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
