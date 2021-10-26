@extends('layouts.user')
@section('title','Pin List')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Traning Pin
  <small></small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Traning Pin</li>
  </ol>
</section>
  <!-- Main content -->
  <section class="content">
      <!-- /.row 1 - small boxes -->
      <div class="box">
          <div class="box-header">
            <span class="pull-left-container">
                @if(Auth::user()->traning_package_create)
                  @else
                   <a href="/pin/create/traning-free-pins" class="small-box-footer">
                  <small class="label pull-left bg-green"><i class="fa fa-plus"></i> Generate </small>
                  </a>
                  @endif

            </span>
            </a>
      
          </div>
          <!-- /.box-header -->
			@if(Session::has('message'))
			<div class="alert alert-success">
					<p>{{Session::get('message') }}</p>
			</div>
			@endif
      <div class="box-body table-responsive" >
      <table id="example" class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Package Name / Package Amount</th>
                  <th>Pin</th>
                  <th>Status</th>
                  <th>Created Date</th>
                  </tr>
              </thead>
              <tbody>
                  @php $i = 1 @endphp
                  @foreach($pins as $pin)
                      <tr>
                      <td>{{$i}}</td>
                      <td> 
                          {{ $pin->package->name}} /    <i class="fa fa-inr" aria-hidden="true"></i>  {{ $pin->package->amount}} / PV:{{ $pin->package->point_value}}

                      </td>
                      <td>{{$pin->pin_number}}</td>
                      <td>   @if($pin->status) Active @else In Active @endif</td>
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