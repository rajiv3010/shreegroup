@extends('layouts.user')
@section('title','Referral')
@section('content')



<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>@yield('title') Income <small><a href="{{ URL::previous() }}" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a></small></h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><small>
                      
                      <a href="/payout/payments" class="btn btn-xs btn-primary">Received</a>
                      <a href="/payout/all_payout" class="btn btn-xs btn-primary">Report</a>
                      <a href="/payout/passbook" class="btn btn-xs btn-primary">Passbook</a>
                    </small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">

                      <thead>
                  <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Total</th>
                  <th>From</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Updated</th>
                  </tr>
              </thead>
              <tbody>
                @php $total=0;$i=1 @endphp
                @foreach($payouts as $payout)
                <tr>
                  <td>{{$i}}</td>
                  <td>{{ date('Y-m-d',strtotime($payout->created_at))}}</td>
                  <td>{{$payout->amount}}</td>
                  <td>@if($payout->type=='g') Generation @else Direct @endif</td>
                  <td>{{$payout->message}}</td>
                  <td>@if($payout->status) Processed @else Unpaid @endif</td>
                  <td>{{date('d-m-Y',strtotime($payout->updated_at))}}</td>
                  
                </tr>
                @php $i++;  $total += $payout->amount @endphp
                @endforeach
              </tbody>
             
               <thead>
                  <tr>
                  <th></th>
                  <th></th>
                  <th>{{$total}}</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  </tr>
              </thead>
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