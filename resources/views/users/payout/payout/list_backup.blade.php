@extends('layouts.user')
@section('title','Dashboard')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Payout
  <small></small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="/payout"><i class="fa fa-dashboard"></i> Payout</a></li>
  <li class="active">All Payout</li>
  </ol>
</section>
  <!-- Main content -->
  <section class="content">
      <!-- /.row 1 - small boxes -->
      <div class="box">
        
          <!-- /.box-header -->
          <div class="box-body table-responsive" >
          <table id="example1" class="table table-responsive table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Binary Payout</th>
                  <th>Direct</th>
                  <th>Ads Payout</th>
                  <th>Application Payout</th>
                  <th>Level Income</th>
                  <th>classified</th>
                  <th>Gross Total</th>
                  <th>Admin Charge</th>
                  <th>TDS Charge</th>
                  <th>Amount Payable</th>
                  <th>Bank Name</th>
                  <th>Date</th>
                  <th>Mode</th>
                  <th>Number</th>
                  <th>Status</th>
                  </tr>
              </thead>
              <tbody>
                {{dd($payouts)}}
                @php 
                    $AdsPayoutT=0;
                    $BinaryPayoutT=0;
                    $LevelIncomeT=0;
                    $ApplicationPayoutT=0;
                    $grostotal=0; 
                    $grosTotalGT=0; 
                    $adminChargesT=0;
                    $amountPayble=0;
                    $amountPaybleT=0;
                    $TDST=0;
                    $AdsPayout=0;
                    $BinaryPayout=0;
                    $LevelIncome=0;
                    $ApplicationPayout=0;
                @endphp
                  @foreach($payouts as $key=>$payout)
                <tr>
                  <td>1</td>
                  <td>{{$key}}</td>
                  @for($i=0; $i<=5;$i++)
                    @if(isset($payout[$i]))
                    @if($payout[$i]->business_area_id ==3)
                      <td>{{ $payout[$i]->amount }}</td>     
                    @endif
                    @if($payout[$i]->business_area_id ==13)
                      <td>{{ $payout[$i]->amount }}</td>     
                    @endif
                    @if($payout[$i]->business_area_id ==1)
                      <td>{{ $payout[$i]->amount }}</td>     
                    @endif
                    @if($payout[$i]->business_area_id ==4)
                      <td>{{ $payout[$i]->amount }}</td>     
                    @endif
                    @if($payout[$i]->business_area_id ==5)
                      <td>{{ $payout[$i]->amount }}</td>     
                    @endif
                    @if($payout[$i]->business_area_id ==6)
                      <td>{{ $payout[$i]->amount }}</td>     
                    @endif
                    @else
                    <td></td>
                    @endif
                  @endfor
                  <td>Gross Total</td>   
                  <td>AC</td>   
                  <td>TDS</td>   
                  <td>Amount pay</td>   
                  <td>Bank Name</td>   
                  <td>Date</td>   
                  <td>Mode</td>   
                  <td>Number</td>   
                  <td>Status</td>   
              </tr>
                  @endforeach
                            
              </tbody>
             
               <thead>
                  <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  </tr>
              </thead>
              </table>
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection