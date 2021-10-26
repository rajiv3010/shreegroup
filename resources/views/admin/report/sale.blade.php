@extends('layouts.admin')
@section('title','Sales Report')
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
            <div class="box-body">
           
              <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">All Register</a></li>
              <li><a href="#tab_2" data-toggle="tab">Assign Pin</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <b>How to use:</b>
                     <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Count</th>
                  <th>Package Name</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pins as $key=>$pins)
                <tr>
                  <td>1</td>
                  <td>{{$pins->package_count}}</td>
                  <td>{{$pins->package->name}}</td>
                  <td>@php $sum = $pins->package->amount* $pins->package_count @endphp 
                    {{$sum}}
                  </td>
                    
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
              
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                 <table id="example" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Package Name</th>
                  <th>Pin Count</th>
                  <th>Amount</th>
                  <th>Service Tax</th>

                </tr>
                </thead>
                <tbody>
                  @php  $sub_total_amount = 0;  $total = 0;@endphp
                @foreach($assignpins as $key=>$assign)
                <tr>
                  <td>1</td>
                  <td>{{$assign->pname}}</td>
                  <td>{{$assign->count}}</td>
                  <td>@php
                         
                          $total_amount = $assign->count* $assign->amount;
                          $sub_total_amount +=$total_amount;
                       @endphp 
                      {{$total_amount}}

                  </td>
                  <td>
                    @php 
                     
                    $sum = $total_amount*18/100 ;
                         
                    @endphp
                    @php  $total +=$sum; @endphp
                      {{$sum}}
                   </td>
                  </td>
                </tr>
                @endforeach
                <tr>
                  <td colspan="3" align="right"> <strong>Total</strong></td>
                  <td >{{ $sub_total_amount }}</td>
                  <td >{{ $total }}</td>
                </tr>
                </tbody>
              </table>
              </div>
        
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
            </div>
            <!-- /.box-body -->
          </div>

          </section>
        <!-- right col -->
      </div>
  @endsection
