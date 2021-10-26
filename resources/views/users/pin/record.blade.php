@extends('layouts.user')
@section('title','Pin Request Record')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>Pin Request Record</h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <h2>Pin<small> Record</small></h2>
                  <div class="clearfix"></div>
               </div>
               <div class="x_content">
                  <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                     <div class="row">
                        <div class="col-sm-12">
                           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                              <thead>
                                 <tr role="row">
                                    <th>#</th>
                                    <th >Pin Quantity</th>
                                    <th>Package</th>
                                    <th>Payment Mode</th>
                                    <th>Reference Number</th>
                                    <th>Bank Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Remark</th>
                                    <th>Receipt</th>
                                 </tr>
                              </thead>
                              <tbody>
                                @foreach($pin_requests as $key=>$pin_request)
                                <tr>
                                   <td>{{$key+1}}</td>
                                   <td class="sorting_1" tabindex="0">{{$pin_request->qty}}</td>
                                   <td>{{$pin_request->package->name}} / {{$pin_request->package->amount}}</td>
                                   <td>{{$pin_request->payment_mode}}</td>
                                   <td>{{$pin_request->reference_number}}</td>
                                   <td>{{$pin_request->bank}}</td>
                                   <td>{{$pin_request->created_at}}</td>
                                   <td>@if($pin_request->status==0)
                                            Pending 
                                          @elseif($pin_request->status==1)
                                            Approved
                                          @elseif($pin_request->status==2)
                                          Rejected
                                          @else
                                          Pending
                                          @endif


                                    </td>
                                   <td>{{$pin_request->remark}}</td>
                                   <td><img width="100" height="auto" src="{{env('base_url')}}documentation/pinRequestReceipt/{{$pin_request->upload_receipt}}"> </td>
                                </tr>
                                @endforeach
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
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