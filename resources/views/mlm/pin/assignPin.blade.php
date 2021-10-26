@extends('layouts.mlm')
@section('title','Pin List')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          Pin Module
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
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
              <form action="/admin/pin/asign" method="POST">   
                  {{csrf_field() }}             
                  <div class="box-body table-responsive" >
                      <div class="form-group col-md-6">
                          <label>Select User</label>
                          <select name="user_id" class="form-control">
                              @foreach($users as $user)
                              <option value="{{$user->id}}" >{{$user->name}}</option>
                              @endforeach
                          </select>
                      </div>
                      <div class="row">
                      <br>
                          <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success">Assign</button></div>
                          <div class="col-lg-3"><button type="button" class="btn btn-block btn-danger">Reset</button></div>
                      </div>
                      <table id="example" class="display" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th></th>
                              <th>#</th>
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
                                <td><input type="checkbox" name="pin_number[]" value="{{$pin->id}}"></td>
                                <td>{{$i}}</td>
                                <td>{{$pin->package->name}}</td>
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