@extends('layouts.admin')
@section('title','Assign Pin List')
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
              <div class="box-header">
              <a href="/admin/pin/add" class="small-box-footer">
              <span class="pull-left-container">
              <small class="label pull-left bg-green"><i class="fa fa-plus"></i> new</small>
              </span>
              </a>
              </div>
              @if ($errors->any())
              <div class="alert alert-danger">
              <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
              </ul>
              </div>
              @endif
              <!-- /.box-header -->
              @if(Session::has('message'))
              <div class="alert alert-success">
              <p>{{Session::get('message') }}</p>
              </div>
              @endif
              <form action="/admin/pin/assign" method="POST" class="assignPinForm">
                  {{csrf_field() }}
                  <div class="box-body table-responsive" >
                      <div class="form-group col-md-3">
                          <label>Enter user Key</label>
                          <input class="form-control assignPinUser" name="user_key" id="assinPinAdminToUser">
                      </div>

                      <div class="form-group col-md-3">
                          <span class="userDetailsDiv"></span>
                      </div>
                  </div>
                   
                        <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success">Assign</button></div>
                          <div class="col-lg-2"><button type="button" class="btn btn-block btn-danger">Reset</button></div>
                      <table id="example1" class="table table-responsive table-bordered table-striped">
                          <thead>
                            <tr>
                              <th></th>
                              <th>#</th>
                              <th>Pin Id</th>
                              <th>Package Name</th>
                              <th>Pin</th>
                              <th>Status</th>
                              <th>Created Date</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $i = 1 @endphp
                            @foreach($pins as $pin)
                              <tr>
                                <td>
                                  @if($pin->status==1)
                                  <input type="checkbox" name="pin_id[]" value="{{$pin->id}}"></td>
                                  @endif
                                <td>{{$i}}</td>
                                <td>{{$pin->id}}</td>
                                <td>@if(isset($pin->package->name)) 
                                        {{$pin->package->name}}
                                      @else
                                      System
                                    @endif
                                  </td>
                                <td>{{$pin->pin_number}}</td>
                                <td>@if($pin->status) Active @else In Active @endif</td>
                                <td>{{date('d M,Y H:s',strtotime($pin->created_at))}}</td>
                              </tr>
                              @php $i++ @endphp
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </form>
          </div>
        </section>
</div>

<!-- /.box-body -->
@endsection
