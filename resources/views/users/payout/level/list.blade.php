@extends('layouts.user')
@section('title','Dashboard')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Level
  <small>Income</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="/payout"><i class="fa fa-dashboard"></i> Payout</a></li>
  <li class="active">Level Income</li>
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
                  <th>Date</th>
                  <th>Total</th>
                  <th>Status</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($levels as $level)
                <tr>
                  <td>{{date('D m Y',strtotime($level->created_at))}}</td>
                  <td>{{round($level->amount,2)}}</td>
                  <td>@if($level->status) Paid @else Unpaid @endif</td>
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