@extends('layouts.user')
@section('title','Team Bonus')
@section('content')



<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>>@yield('title')</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>>@yield('title')</h2>
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
                          <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Date: activate to sort column descending">Date</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="User By: activate to sort column descending">User By</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1"  aria-label="Left PV: activate to sort column ascending">Left PV</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Right PV: activate to sort column ascending">Right PV</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Balance PV: activate to sort column ascending">Balance PV</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Total: activate to sort column ascending">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                      @php $total=0;$i=1 @endphp
                      @foreach($binary_payouts as $payout)
                      <tr>
                      <td>{{$i}}</td>
                      <td>{{ date('d-m-Y h:i a',strtotime($payout->inserted_at))}}</td>
                      <td>{{$payout->user_by}}</td>
                      <td>{{$payout->blpv}}</td>
                      <td>{{$payout->brpv}}</td>
                      <td>{{$payout->bpv}}</td>
                      <td>{{$payout->amount}}</td>
                      </tr>
                      @php $i++;  $total += $payout->amount @endphp
                      @endforeach
                      </tbody>

                      <thead>
                        <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>{{$total}}</th>
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