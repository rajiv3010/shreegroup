@extends('layouts.admin')
@section('title','TDS | '.$year)
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        @yield('title')
      </h1>
      <ol class="breadcrumb">
         <li><a href="/admin/home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">@yield('title')</li>
      </ol>
    </section>
    <div class="row">      
<div class="col-lg-8">
  <section class="col-lg-12">
    
            <div class="box">
            <div class="box-body table-responsive">
    <table id="example1" class="dataTables table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Month</th>
                  <th>TID</th>
                  <th>Name</th>
                  <th>PAN</th>
                  <th>Amount</th>
                  <th>Date</th>

                </tr>
                </thead>
                <tbody>
                @foreach( $tdsUsers as $tdsUser)
                @if($tdsUser->user->is_pan_verified==2)
                <tr>
                  <?php $monthNum = $tdsUser->month;
                      $dateObj = DateTime::createFromFormat('!m', $monthNum);
                      $monthName = $dateObj->format('F');?>
                  <td>{{$loop->iteration}}</td>
                   <td>{{ $monthName }}</td>
                  <td>{{ $tdsUser->user_key}}</td>
                  <td>{{$tdsUser->user->name}}  </td>
                  <td>{{$tdsUser->user->pan}}  </td>
                  <td>{{$tdsUser->tds}}</td>
                  <td>{{date('d-m-Y',strtotime($tdsUser->created_at))}}</td>
                </tr>
                @endif
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
  </section>
</div>
<div class="col-lg-4">
  
    <!-- Main content -->
    <section class=" col-lg-12">
      <!-- Small boxes (Stat box) -->
            <div class="box ">
             @if(Session::has('message'))
            <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
            </div>
            @endif
            <!-- /.box-header -->
            <div class="box-body table-responsive">
               <table  class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Year</th>
                  <th>Amount</th>
                  <th>Details</th>

                </tr>
                </thead>
                <tbody>
                @foreach( $payouts as $payout)
                <tr @if($year==$payout->year) style="background-color: #dff0d8; border: 1px solid; box-shadow: 0px 3px 6px -1px;" @endif>
                  <td>{{$loop->iteration}}</td>
                  <td>{{ $payout->year}}</td>
                  
                  <td>{{$payout->tds}}</td>
                  <td><a href="/admin/report/tds?year={{$payout->year}}" class="btn btn-warning btn-xs"> Detail</a></td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          </section>
        <!-- right col -->

    <!-- Main content -->
    <section class=" col-lg-12">
      <!-- Small boxes (Stat box) -->
            <div class="box ">
             @if(Session::has('message'))
            <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
            </div>
            @endif
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table  class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Year</th>
                  <th>Month</th>
                  <th>Amount</th>
                  <th>Details</th>

                </tr>
                </thead>
                <tbody>
                    @foreach( $payoutsMonth as $pMonth)
                        <tr @if($month == $pMonth->month) style="background-color: #dff0d8;
    border: 1px solid;
    box-shadow: 0px 3px 6px -1px;"  @else @endif>
                        @php  $monthNum = $pMonth->month;
                        $dateObj = DateTime::createFromFormat('!m', $monthNum);
                        $monthName = $dateObj->format('F'); @endphp
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $pMonth->year}}</td>
                        <td>{{ $monthName }}</td>
                        <td>{{$pMonth->tds}}</td>
                        <td><a href="/admin/report/tds?year={{$year}}&month={{$pMonth->month}}" class="btn btn-warning btn-xs"> Detail</a></td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          </section>
          </div>

        <!-- right col -->
      </div>
      </div>
  @endsection
