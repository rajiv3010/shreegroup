@extends('layouts.user')
@section('title','Received Income')
@section('content')



<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>@yield('title')  - <a href="/payout/payments/details" class="btn btn-primary btn-xs">Details</a> <a href="{{ URL::previous() }}" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>
                      <small>
                      <a href="/payout/payments" class="btn btn-xs btn-primary">Received</a>
                      <a href="/payout/all_payout" class="btn btn-xs btn-primary">Report</a>
                      <a href="/payout/passbook" class="btn btn-xs btn-primary">Passbook</a>
                    </small>
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">

                      <thead>
                        <tr role="row">
                          <th>#</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Amount: activate to sort column descending">Amount</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1"  aria-label="Status: activate to sort column ascending">Status</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Date: activate to sort column ascending">Date</th>
                        </tr>
                      </thead>
                      <tbody>
                      @php $i=1 @endphp
                      @foreach($myPayments as $myPayment)
                      <tr>
                      <td>{{$i}}</td>
                      <td>{{$myPayment->amount}}</td>
                      <td>@if($myPayment->status==0)
                      <span class="label label-danger">Released</span>
                      @elseif($myPayment->status==1)
                      <span class="label label-danger">Stopped</span>
                      @elseif($myPayment->status==2)
                      <span class="label label-info">Processed</span>
                      @elseif($myPayment->status==3)
                      <span class="label label-warning">Bank Process</span>
                      @elseif($myPayment->status==4)
                      <span class="label label-success">Paid</span>
                      @endif
                      </td>
                      <td>{{$myPayment->created_at}}</td>
                      </tr>
                      @php $i++;  @endphp
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