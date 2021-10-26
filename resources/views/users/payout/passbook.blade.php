@extends('layouts.user')
@section('title','Passbook')
@section('content')



<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>@yield('title') <small> <a href="{{ URL::previous() }}" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a></small></h3>
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
                          <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Date: activate to sort column descending">Date</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1"  aria-label="Particulars: activate to sort column ascending">Particulars</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Debit: activate to sort column ascending">Debit</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Credit: activate to sort column ascending">Credit</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Balance: activate to sort column ascending">Balance</th>
                        </tr>
                      </thead>
                      <tbody>
                      @php $i=1 ;$sumnew=0;$sum=0;$debit=0;$credit=0 @endphp
                      @foreach($passbooks as $passbook)
                      <tr>
                      <td>{{$i}}</td>
                      <td>{{ date('Y-m-d',strtotime($passbook->created_at))}}</td>
                      <td>{{$passbook->message}}</td>
                      @if($passbook->txn_type=='d')
                      <td>{{round($passbook->earning,2)}}</td>
                      <td>0</td>
                      @php $sum -=round($passbook->earning,2)  @endphp
                      @else
                      <td>0</td>
                      <td>{{round($passbook->earning,2)}}</td>
                      @php $sum =round($passbook->earning,2)  @endphp
                      @endif
                      @if($sumnew)
                      @php $sumnew = $sumnew+$sum @endphp
                      @else
                      @php $sumnew = $sum @endphp
                      @endif
                      <td><i class="fa fa-inr" aria-hidden="true"></i>{{round($sumnew,2)}}</td>
                      </tr>
                      @php $i++;  @endphp
                      <tr>
                      <td>{{$i}}</td>
                      <td>{{ date('Y-m-d',strtotime($passbook->created_at))}}</td>
                      <td>Deduction by admin charges</td>
                      <td>{{$passbook->admin_charges}}</td>
                      <td>0</td>
                      <td>@php $balanceA = round($sumnew,2)-$passbook->admin_charges @endphp <i class="fa fa-inr" aria-hidden="true"></i>{{$balanceA}} </td>
                      </tr>
                      @php $i++;  @endphp
                      <tr>
                      <td>{{$i}}</td>
                      <td>{{ date('Y-m-d',strtotime($passbook->created_at))}}</td>
                      <td>Deduction by TDS</td>
                      <td>{{$passbook->tds}}</td>
                      <td>0</td>
                      <td>@php $balance = $balanceA-$passbook->tds @endphp <i class="fa fa-inr" aria-hidden="true"></i>{{$balance}} </td>
                      </tr>
                      @php $i++; $sumnew=$balance; @endphp
                        @php $i++;  @endphp
                      <tr>
                      <td>{{$i}}</td>
                      <td>{{ date('Y-m-d',strtotime($passbook->created_at))}}</td>
                      <td>Deduction by PST</td>
                      <td>{{$passbook->PST}}</td>
                      <td>0</td>
                      <td>@php $balanceB = $balance-$passbook->PST @endphp <i class="fa fa-inr" aria-hidden="true"></i>{{$balanceB}} </td>
                      </tr>
                      @php $i++; $sumnew=$balanceB; @endphp
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