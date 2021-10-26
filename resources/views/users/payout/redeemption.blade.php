@extends('layouts.user')
@section('title','Redeemption')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Redeemption
  <small>Payout</small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="/payout"><i class="fa fa-dashboard"></i> Payout</a></li>
  <li class="active">Redeemption</li>
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
                  <th>Earning</th>
                  <th>Deduction</th>
                 
                  </tr>
              </thead>
              <tbody>
                @php  $sum = 0; $i=1 @endphp
              @foreach($redeemptions as $redeemption)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{$redeemption->created_at}}</td>
                  <td>{{$redeemption->earning}}</td>
                  <td>{{$redeemption->amount}}</td>
                  <td>@php 
                    $tax=$redeemption->tds+$redeemption->admin_charges;
                          $sum += $redeemption->amount;
                    $i++;
                    @endphp

                          {{$tax}} <small>({{$redeemption->tds}})+({{$redeemption->admin_charges}})</small>
                   </td>
                 
                </tr>
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