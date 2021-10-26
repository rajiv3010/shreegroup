@extends('layouts.user')
@section('title','Club')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Club Income
  <small></small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Club</li>
  </ol>
</section>
  <!-- Main content -->
  <section class="content">
      <!-- /.row 1 - small boxes -->
      <div class="box">
        
          <!-- /.box-header -->
          <div class="box-body table-responsive" >
             <table id="" class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Amount</th>
                  <th>Earned</th>
                  <th>Deduction</th>
                  </tr>
              </thead>
              <tbody>
                @php $sum = 0;$i=1 @endphp
                @foreach($logs as $log)
                <tr>
                  <th>{{$i}}</th>
                  <th>{{$log->created_at}}</th>
                  <th>{{$log->amount}}</th>
                  <th>{{$log->earning}}</th>
                  @php 
                  $tax= $log->tds+$log->admin_charges;
                  $sum += $log->earning;
                   @endphp
                  <th>{{$tax}}</th>
                  </tr>

                    @php $i++; @endphp
                  @endforeach
              </tbody>
               <thead>
                  <tr>
                  <th></th>
                  <th></th>
                  <th>Total</th>
                  <th>{{$sum}}</th>
                  </tr>

              </thead>
              </table>
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection
