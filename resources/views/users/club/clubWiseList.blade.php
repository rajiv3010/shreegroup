@extends('layouts.user')
@section('title','Club Wise Report')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
        <small>Club Wise Report</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >User</li>
        <li class="active">Dashboard</li>
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
              <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Club Name</th>
                  <th>Left</th>
                  <th>Right</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                  @php $grandTotal = 0 @endphp
                @foreach($clubs as $club )
                <tr>

                  <td>{{$club->name}}</td>
                  <td>{{$club->left}}</td>
                  <td>{{$club->right}}</td>
                  <td>
                    @php $sum =   $club->right +$club->left @endphp

                    {{$sum}}
                    @php $grandTotal +=$sum; @endphp
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td></td>
                  <td></td>
                  <td>Grand Total</td>
                  <td>{{$grandTotal}}</td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          </section>
        <!-- right col -->
      </div>
  @endsection
