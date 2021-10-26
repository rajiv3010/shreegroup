@extends('layouts.admin')
@section('title','Payouts')
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

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->


<div class="box">
            <div class="box-header">
              
            </div>
             @if(Session::has('message'))
            <div class="alert alert-success">
            <p>{{Session::get('message') }}</p>
            </div>
            @endif
            <!-- /.box-header -->
             <div class="box-body table-responsive" >
            <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>User</th>
                  <th>Earning</th>
                  <th>TDS</th>
                  <th>Admin Charges</th>
                  <th>Net Amount</th>
                  <th>%</th>
                  <th>Income From</th>
                  <th>Status</th>
                  <th>Message</th>
                  <th>Type</th>
                  <th>Txn_type</th>
                  <th>Created</th>
                  <th>Updated</th>
                </tr>

                </tr>
                </thead>
                <tbody>
                @foreach( $payouts as $key=>$payout)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$payout->user_key}} | {{$payout->user->name}}</td>
                  <td>{{$payout->earning}}</td>
                  <td>{{$payout->tds}}</td>
                  <td>{{$payout->admin_charges}}</td>
                  <td>{{$payout->amount}}</td>
                  <td>{{$payout->percentage}}</td>
                  <td>{{$payout->businessarea->area_name}}</td>
                  <td>
                    @if($payout->status == 0)
                    <span class="label label-danger">Unpaid</span>
                    @else
                    <span class="label label-success">Processed</span>
                    @endif
                  </td>
                  <td>{{$payout->message}}</td>
                  <td>
                    @if($payout->type == 'g' )
                      Generation
                    @else
                      Direct
                    @endif
                  </td>
                  <td>
                    @if($payout->txn_type == 'c')
                      Credit
                    @else
                      Debit
                    @endif
                  </td>
                  <td>{{$payout->created_at}}</td>
                  <td>{{$payout->updated_at}}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          </section>
        <!-- right col -->
      </div>
  @endsection
