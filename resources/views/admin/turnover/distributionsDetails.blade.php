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

         <div class="box-header">
            <a href="{{ URL::previous() }}" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a>
         </div>

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
                           <th>Amount</th>
                           <th>Income From</th>
                           <th>Created</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php $totalAmount =0 @endphp
                        @foreach($payouts as $key=> $payout)                      
                        <tr>
                           <td>{{$key+1}}</td>
                           <td>{{$payout->user_key}} | {{$payout->user->name}}</td>
                           <td>{{$payout->amount}}</td>
                           <td>{{$payout->businessarea->area_name}}</td>
                           <td>{{$payout->created_at}}</td>
                            @php $totalAmount +=$payout->amount @endphp
                        </tr>
                        @endforeach
                        <tr>
                           <td></td>
                           <td>Total:</td>
                           <td>{{$totalAmount}}</td>
                           <td></td>
                           <td></td>
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