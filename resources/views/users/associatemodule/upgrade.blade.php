@extends('layouts.user')
@section('title','Upgrade')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Upgrade</h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Package<small> Upgrade</small></h2>
                  <div class="clearfix"></div>
                  <a href="/pin/request" class="btn btn-success">Pin Request</a>
               </div>
               @if(count($PinRequests))
               <div class="x_content" >
                  
        <form class="login-form " role="form" method="POST" action="/topUp">
        {{ csrf_field() }}
        <div class="login-box-body">
        <!-- /.login-logo -->
        <div class=".messageDiv">
        <div class="message"></div>

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
        @if(Session::has('message'))
        <div class="alert alert-success">
        <p>{{Session::get('message') }}</p>
        </div>
        @endif
        <div class="login-box-body">

        {{ csrf_field() }}
        <div class="row">
        <div class="col-md-6">
        <div class="form-group has-feedback">
        <label>Package</label>
        <select name="package_id" id="addNew_package" class="form-control">
        <option value="0">Select Package</option>
        @foreach($PinRequests as $PinRequest)
        <option value="{{$PinRequest->package->id}}">{{$PinRequest->package->name}}-{{$PinRequest->package->amount}}</option>
        @endforeach
        </select>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group has-feedback">
        <label>PIN</label>
        <select class="form-control addNewUserPin" id="id"  name="pin">
        </select>
        </div>
        </div>

        </div>
        </div>
        </div>

        <div class="login-box-body">
        <div class="col-xs-12 col-md-2">
        <button type="submit" class="btn btn-primary addNewUser">Upgrade</button>
        </div>
        </div>
        </div>
        @endif
        <!-- Container -->
        <br>
        <br>
        </form>
       
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
   </div>
   <div class="clearfix"></div>
</div>
<!-- /page content -->

@endsection