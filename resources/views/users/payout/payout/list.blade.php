@extends('layouts.user')
@section('title','Payout Report')
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


                         

                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Referral: activate to sort column ascending">Level Income</th>
                       
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1"  aria-label="Binary: activate to sort column ascending">Referral Income</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1"  aria-label="Binary: activate to sort column ascending">Self Cash Back</th>
                          
                          

                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Amount Payable: activate to sort column ascending">Amount Payable</th>

                        </tr>
                      </thead>
                      <tbody>
                      @php 

                      $total1=0;
                      $teamBonus=0;
                      $LevelIncome=0;
                      $SelfCashBack=0;
                      $DirectIncome=0;
                      $inc=1;
                      $sumb1=0;
                      $sumb2=0;
                      $sumb3=0;
                      $sumb4=0;
                      $sumb5=0;
                      $sumb6=0;
                      $sumb7=0;
                      $sumb13=0;
                      $sumb14=0;
                      $sumb15=0;
                      @endphp
                      @foreach($payouts as $key=> $payout)
                      <tr>
                      <td>{{$inc}}</td>
                      @foreach($payout as $pay)

                      
                      @if($pay->business_area_id==1 && $pay->type=='d')
                      @php $sumb1 +=$pay->amount; @endphp
                      @else
                      @php $sumb1 +=0; @endphp
                      @endif

                      
                      @if($pay->business_area_id==2)
                      @php $sumb2 +=$pay->amount; @endphp
                      @else
                      @php $sumb2 +=0; @endphp
                      @endif

                      @if($pay->business_area_id==3)
                      @php $sumb3 +=$pay->amount; @endphp
                      @else
                      @php $sumb3 +=0; @endphp
                      @endif

                      @if($pay->business_area_id==4)
                      @php $sumb4 +=$pay->amount; @endphp
                      @else
                      @php $sumb4 +=0; @endphp
                      @endif
                     

                  

                      @endforeach
                      <td>{{$key}} </td>
                      <td>{{$sumb3}} </td>
                      <td>{{$sumb2}} </td>
                      <td>{{$sumb4}} </td>
                      @php    $total =$sumb1+$sumb2+$sumb3+$sumb4+$sumb5+$sumb6+$sumb7+$sumb13+$sumb14+$sumb15  @endphp
                      <td>{{$total}}</td>
                      </tr>
                      @php 

                      $inc++; 
                      $total1 += $total;
                      $teamBonus += $sumb1;
                      $LevelIncome += $sumb3;
                      $SelfCashBack += $sumb4;
                      $DirectIncome += $sumb2;

                      $sumb1=0;
                      $sumb2=0;
                      $sumb3=0;
                      $sumb4=0;
                      $sumb5=0;
                      $sumb6=0;
                      $sumb7=0;
                      $sumb14=0;
                      $sumb13=0;
                      $sumb15=0;

                      
                      @endphp
                      @endforeach

                      </tbody>

                      <thead>
                        <tr role="row">
                          <th>&nbsp;&nbsp;</th>
                          <th>&nbsp;&nbsp;</th>
                          <th>{{$LevelIncome}}</th>
                          <th>{{$DirectIncome}}</th>
                          <th>{{$SelfCashBack}}</th>
                          <th>{{$total1}}</th>
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