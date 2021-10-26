@extends('layouts.user')
@section('title','Dashboard')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Single Leg
  <small>Payout</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="/payout"><i class="fa fa-dashboard"></i> Payout</a></li>
  <li class="active">single Leg</li>
  </ol>
</section>
  <!-- Main content -->
  <section class="content">
      <!-- /.row 1 - small boxes -->
      <div class="box">
        
          <!-- /.box-header -->
          <div class="box-body table-responsive" >
             <table id="example" class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>%</th>
                  <th>Message</th>
                 
                  </tr>
              </thead>
              <tbody>
                @php $total=0;$i=1 @endphp
                @foreach($binary_payouts as $payout)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{ date('Y-m-d',strtotime($payout->created_at))}}</td>
                  <td>{{$payout->amount}}</td>
                  <td>{{$payout->percentage}}</td>
                  <td>{{$payout->message}}</td>
                 
                </tr>
                @php $i++; $total += $payout->amount  @endphp
                @endforeach
              </tbody>

              <thead>
                  <tr>
                  <th></th>
                  <th></th>
                  <th>{{$total}}</th>
                  <th></th>
                  <th></th>
                  </tr>
              </thead>
              </table>
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection