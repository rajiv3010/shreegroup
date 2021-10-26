@extends('layouts.admin')
@section('title','Payment History - Details')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  @yield('title')<small><a href="{{ URL::previous() }}" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a></small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')</li>
  </ol>
</section>
  <!-- Main content -->
  <section class="content">
      <!-- /.row 1 - small boxes -->
      <div class="box">
          <!-- /.box-header -->
          <div class="box-body table-responsive" >
            <form class="" action="/admin/payment-release-history-data/changeStatus" method="post">
              @csrf
          <table  class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th># <input type="checkbox"  value="all" class="checkAllPaymentIds"> </th>
                  <th>Name</th>
                  <th>ID</th>
                  <th>PAN No</th>
                  <th>Bank Name</th>
                  <th>Account No</th>
                  <th>Branch</th>
                  <th>IFSC</th>
                  <th>City</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Date</th>
              
                  
                  </tr>
              </thead>
              <tbody>
                @php $i = 1;$total=0 @endphp
              @foreach($data as $value)
              @if(isset($value->user->name))
                <tr>
                  <td>{{$i}}| 
                    @if($value->status==3)
                    <input type="checkbox" name="payment_id[]" value="{{$value->id}}" class="payment_id"></td>
                    @endif
                  <td>{{$value->user->name}}</td>
                  <td>{{$value->user->user_key}}</td>
                  <td>{{$value->user->pan}}</td>
                  <td> @if($value->user->bankDetails) {{$value->user->bankDetails->name}} @else - @endif</td>
                  <td> @if($value->user->bankDetails) {{$value->user->bankDetails->account_no}} @else - @endif</td>
                  <td> @if($value->user->bankDetails) {{$value->user->bankDetails->branch}} @else - @endif</td>
                  <td> @if($value->user->bankDetails) {{$value->user->bankDetails->ifsc}} @else - @endif</td>
                  <td> @if($value->user->bankDetails) {{$value->user->bankDetails->city}} @else - @endif</td>
                  <td>{{$value->amount}}</td>
                  <td>@if($value->status==0)

                      @elseif($value->status==1)
                      <span class="badge badge-success">Release</span>                      
                      @elseif($value->status==2)
                      <span class="badge badge-danger">Stop</span>
                      @elseif($value->status==3)
                      <span class="badge badge-info">Proccessed</span>
                      @elseif($value->status==4)
                      <span class="badge badge-success">Paid</span>
                      @else
                      <span class="badge badge-success">NA</span>
                      @endif
                  </td>
                  <td>{{$value->created_at}}</td>
                   
                </tr>
                @endif
                @php $i++; $total += $value->amount @endphp
                @endforeach

              </tbody>
              <thead>
                  <tr>
                  <th>&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;</th>
                  <th>{{$total}}</th>
                  <th>&nbsp;&nbsp;</th>
                  <th>&nbsp;&nbsp;</th>
              
                  
                  </tr>
              </thead>
             
             
              </table>
              <button class="btn btn-success" type="submit">Change Status to Paid</button>
             </form>

          </div>
          
          </div>
        </section>
      </div>
  <!-- /.box-body -->
  @endsection