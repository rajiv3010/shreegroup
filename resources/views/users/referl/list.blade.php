@extends('layouts.user')
@section('title','Team Bonus Status')
@section('content')


<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>@yield('title')</h3>
                
<h2>Team A:{{auth::user()->balance_pv_left}}</h2>

<h2>Team B:{{auth::user()->balance_pv_right}}</h2>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_title">
                      <h2>@yield('title')</h2>
                      <div class="clearfix"></div>
                      </div>
                        <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                          <div class="row">
                            <div class="col-sm-12">
                              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">

                              <thead>
                              <tr role="row">
                              <th>#</th>
                              <th aria-controls="datatable-responsive" rowspan="1" colspan="1"  aria-label="Date: activate to sort column descending">Date</th>
                              <th aria-controls="datatable-responsive" rowspan="1" colspan="1"  aria-label="User By: activate to sort column descending">User By</th>
                              <th aria-controls="datatable-responsive" rowspan="1" colspan="1"  aria-label="Left PV: activate to sort column ascending">Team A - PV</th>
                              <th aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Right PV: activate to sort column ascending">Team B - PV</th>
                              <th aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Balance PV: activate to sort column ascending">Balance PV</th>
                              <th aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Balance PV: activate to sort column ascending">Amount</th>
                              </tr>
                              </thead>
                              <tbody>
                              @php $i=1 @endphp
                              @foreach($binary_payouts as $payout)
                              <tr>
                              <td>{{$i}}</td>
                              <td>{{date('d-m-Y',strtotime($payout->created_at))}}</td>
                              <td>{{$payout->user_by}}</td>
                              <td>{{$payout->blpv}}</td>
                              <td>{{$payout->brpv}}</td>
                              <td>{{$payout->bpv}}</td>
                              <td>{{$payout->amount}}</td>

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
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
        </div>
        <!-- /page content -->


    

@endsection