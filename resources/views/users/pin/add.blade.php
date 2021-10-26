@extends('layouts.user')
@section('title','Pin Request')
@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Pin Request</h3>
              </div>

            </div>
            <div class="clearfix"></div>

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
<div class="alert alert-danger">
<p>{{Session::get('message') }}</p>
</div>
@endif

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Request <small> Form</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">



<form method="POST" action="/pin/store" accept-charset="UTF-8" enctype="multipart/form-data">
@csrf
            <div class="row">
                <div class="form-group col-lg-3">
                  <label>Packages</label>
                  <select name="package_id"  class="form-control">
                    @foreach($packages as $package)
                    <option value="{{$package->id}}">{{$package->name}}</option>
                    @endforeach
                   
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label>Qty</label>
                  <input type="number" max="100" name="qty" required="required" value="10" class="form-control" placeholder="Enter number of pin Generate">
                </div>
                <div class="form-group col-lg-3">
                  <label>Payment Mode</label>
                  <select name="payment_mode"  class="form-control">
                    <option value="0">---Select Option---</option>
                    <option value="NA">NA</option>
                    <option value="Cash">Cash</option>
                    <option value="NEFT">NEFT</option>
                    <option value="Cheque">Cheque</option>
                    <option value="DD">DD</option>
                    <option value="UPI">UPI</option>
                    <option value="PayTm">PayTm</option>
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label>Bank</label>
                  <select name="bank"  class="form-control">
                    <option value="0">---Select Option---</option>
                    <option value="NA">NA</option>
                  @foreach($Banking as $value)
                    <option value="{{$value->bank_name}} - {{$value->company_name}}">{{$value->bank_name}} - {{$value->company_name}}</option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group col-lg-3">
                  <label>Reference Number</label>
                  <input type="text"  name="reference_number" value="" class="form-control" placeholder="Enter Reference Number">
                </div>
                
                <div class="form-group col-lg-3">
                  <label>Upload Receipt</label>
                  <input type="file"  name="upload_receipt"  class="form-control" accept="image/x-png,image/gif,image/jpeg" >
                </div>
                <div class="form-group col-lg-3">
                  <label>Customer Bank</label>
                  <input type="text"  name="provider_bank" value="" class="form-control" placeholder="Customer Bank">
                </div>
                <div class="form-group col-lg-3">
                  <label>Date</label>
                  <input type="date"  name="request_date" placeholder="" class="form-control" >
                </div>
                <div class="form-group col-lg-3">
                  <label>Time</label>
                  <input type="time"  name="request_time" placeholder="" class="form-control" >
                </div>
                
                <div class="form-group col-lg-3">
                  <label>Remarks</label>
                  <input type="text"  name="remark" placeholder="Remarks" class="form-control" >
                </div>
                

                </div>
                <div class="ln_solid"></div>
                <div class="row" align="center">

                <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success">Submit</button></div>
                </div>
      
      </form>
    @if(auth::user()->is_pan_verified==2 && auth::user()->is_adhaar_verified==2 && auth::user()->bank_kyc_status==2)
    
      @else

      Pin Request can be send only after KYC verification
      <a class="" href="/member/profile">
      <div class="btn btn-warning">
        Click Here to verify your KYC 
        
      </div>
      </a>
      @endif
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
@endsection