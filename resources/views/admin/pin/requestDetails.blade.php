@extends('layouts.admin')
@section('title','Pin Request Details')
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
      <!-- /.row 1 - small boxes -->
      <div class="box">
          <!-- /.box-header -->
         @if(Session::has('message'))
         <div class="alert alert-success">
               <p>{{Session::get('message') }}</p>
         </div>
         @endif
            <div class="box-body dataRow">
              <h3>Count: {{count($pins)}}</h3>
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Package Name</th>
                  <th>Pin</th>
                  <th>Amount</th>
                  <th>Allotted To</th>
                  <th>Used By</th>
                  <th>Status</th>
                  <th>Used At</th>
                  <th>Date</th>
                  </tr>
              </thead>
              <tbody>
                  @php $i = 1 @endphp
                  @foreach($pins as $pin)
                      <tr>
                      <td>{{$i}}</td>
                      <td> @if(isset($pin->package->name)){{$pin->package->name}} @endif</td>
                      <td>{{$pin->pin_number}}</td>
                      <td>{{$pin->package->amount}}</td>
                      <td>
                          {{$pin->pin_owner}}
                      </td>
                      <td>  
                            @if(isset($pin->usedBy->name)){{$pin->usedBy->name}} / {{$pin->usedBy->user_key}} @endif  </td>


 
                      <td>@if($pin->status==1) Active @elseif($pin->status==0) Used  @elseif($pin->status==2) Allotted @else -@endif</td>
                      <td>@if($pin->used_at==null)
                        @else
                        {{date('d M,Y',strtotime($pin->used_at))}}
                      @endif
                    </td>
                      <td>{{date('d M,Y H:s',strtotime($pin->created_at))}}</td>
                      </tr>
                  @php $i++ @endphp
                  @endforeach
                 
      
              </tbody>
              </table>
           
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection