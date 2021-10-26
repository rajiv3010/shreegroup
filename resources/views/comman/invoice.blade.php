@extends('layouts.user')
@php $invoice_name  = Auth::user()->name.'| receipt'; @endphp
@section('title',$invoice_name)
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Receipt <small></small></h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12">
            <div class="x_panel">
               <div class="x_content">
                  <section class="content invoice" id="prinInvoice">
                     <!-- title row -->
                     <div class="row">
                        <div class="col-xs-12 invoice-header">
                           <h1>
                              <img src="{{env('company_logo')}}" style="width: 50px;">
                              <small class="pull-right">Date: {{date('d-M-Y',strtotime(Auth::user()->created_at))}}</small>
                           </h1>
                        </div>
                        <!-- /.col -->
                     </div>
                     <!-- info row -->
                     <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                           From
                           <address>
                              <strong>{{env('company_name')}}</strong>
                              <br>{{env('company_address1')}}
                              <br>{{env('company_address2')}}
                              <br>{{env('company_address3')}}
                              <br>{{env('company_pincode')}}
                              <!--  <br>Phone: {{env('company_phone1')}} -->
                              <br>Email: {{env('company_email_support')}}
                           </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                           To
                           <address>
                              <strong class="text-capitalize">{{Auth::user()->name}}</strong>
                              <br><span class="text-capitalize">{{Auth::user()->address1}},{{Auth::user()->address2}}</span>
                              <br><span class="text-capitalize">@if(isset(Auth::user()->city_name->name)) {{Auth::user()->city_name->name}},{{Auth::user()->state_name->name}}</span>
                              @endif
                              <br>Phone: +91 {{Auth::user()->mobile}}
                              <br>Email: {{Auth::user()->email}}
                           </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                           <b>Package:</b> ₹ {{Auth::user()->package->amount}}/-
                           <br><strong class="text-capitalize"><b>Tracking ID:</b> {{Auth::user()->user_key}}</strong>
                           <br><b>PAN:</b> <span class="text-uppercase">{{Auth::user()->pan}}</span>
                        </div>
                        <!-- /.col -->
                     </div>
                     <!-- /.row -->
                     <!-- Table row -->
                     <div class="row">
                        <div class="col-xs-12 table" >
                           <table class="table-responsive table-bordered table">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>Package</th>
                              </thead>
                              <tbody>
                                 
                                 <tr>
                                    <td>1</td>
                                    <td>{{Auth::user()->package->name}} / {{Auth::user()->package->amount}}</td>
                                 </tr>
                                
                              </tbody>
                           </table>
                        </div>
                        <!-- /.col -->
                     </div>
                     <!-- /.row -->
                     <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                           <p class="lead">PAYMENT TERMS AND POLICIES:</p>
                           <p class="text-muted well well-sm no-shadow" style="margin-top: 10px; font-size: 10px;">
                              I am purchasing property in {{env('company_name')}} with my best knowledge and understanding. I have studied all the terms and condition and I am taking this property voluntarily.
                           </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">
                           <p class="lead">Amount </p>
                           <div class="table-responsive">
                              <table class="table">
                                 <tbody>
                                    <tr>
                                       <th>Total:</th>
                                       <td>₹ {{Auth::user()->package->amount}}/-</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <!-- /.col -->
                     </div>
                     <!-- /.row -->
                     <div class="row">
                        <div class="col-md-12">
                           <h5>Note:</h5>
                           <p>Must keep a photo copy of this receipt for your own records. <br>
                              It is the responsibility of the Selling Associate to verify the age of Purchasing Associate and to provide us authentic signatures of the Purchasing Associate.<br>
                              Please note that signing on behalf of somebody else is a serious offence.<br>
                              <span style="float: left;">Copyright © {{env('company_name')}}</span>
                              <span style="float: right;">GST :{{env('company_gst')}}</span>
                           </p>
                        </div>
                     </div>
                     <!-- div for ivoice -->
                     <!-- this row will not appear when printing -->
                  </section>
               </div>
            </div>
            <div class="row no-print">
               <div class="col-xs-6">
                  <button class="btn btn-default" onclick="printDiv('prinInvoice')">
                  <i class="fa fa-print"></i> Print</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   function printDiv(divName) {
   var printContents = document.getElementById(divName).innerHTML;
   var originalContents = document.body.innerHTML;
   
   document.body.innerHTML = printContents;
   
   window.print();
   
   document.body.innerHTML = originalContents;
   }
</script>
@endsection