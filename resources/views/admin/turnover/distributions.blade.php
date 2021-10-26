@extends('layouts.admin')
@section('title','Turnover Distribution')
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
      <div class="box box-success">
         @if(Session::has('message'))
         <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
         </div>
         @endif
         <!-- /.box-header -->
         <div class="box-body table-responsive" >
            <table class="table table-responsive-lg table-bordered table-striped table-sm mb-0">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>User</th>
                     <th>Package Cost</th>
                     <th>Distributed</th>
                     <th>Details</th>
                  </tr>
               </thead>
               <tbody>
                  @php $total = 0;$package=0;$gst=0;$binary=0;$bonus=0;$winners=0;$autopool=0; @endphp
                  @foreach($orders as $key=> $value)
                  <tr>
                     <td>{{$key+1}}</td>
                     <td>
                        @isset($value->activity->user)
                        {{$value->activity->user->user_key}} | {{$value->activity->user->name}}
                        @else
                        NA
                        @endisset
                     </td>
                     <td>
                        @isset($value->activity->user)
                        {{number_format($value->activity->user->package->amount)}}
                        @else
                        0
                        @endisset
                     </td>
                     <td>{{number_format($value->amountTOTAL)}}</td>
                     <td><a href="/admin/distributions/details/{{$value->activity_id}}" class="btn btn-xs btn-info">View</a></td>
                     @php $total += $value->amountTOTAL;$package+=0; @endphp
                  </tr>
                  @endforeach
                  <tr>
                     <td></td>
                     <td>-</td>
                     <td>{{number_format($package)}}</td>
                     <td>{{number_format($total)}}</td>
                     <td>-</td>
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