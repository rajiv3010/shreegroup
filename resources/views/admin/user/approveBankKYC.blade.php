@extends('layouts.admin')
@section('title','Approve Bank KYC')
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
         <div class="col-md-12">
         <a href="/admin/user/approve-bank-kyc/1" class="btn btn-success">Under Review</a>
         <a href="/admin/user/approve-bank-kyc/0" class="btn btn-warning">Pending</a>
         <a href="/admin/user/approve-bank-kyc/2" class="btn btn-primary">Accepted</a>
         <a href="/admin/user/approve-bank-kyc/3" class="btn btn-danger">Rejected</a>
         </div>
         <!-- /.box-header -->
         <div class="box-body dataRow table-responsive" >
            <table id="example" class="dataTables table table-bordered table-striped ">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>User Name</th>
                     <th>Name</th>
                     <th>Bank Name</th>
                     <th>Account number</th>
                     <th>SWIFT Code</th>
                     <th>IFSC Code</th>
                     <th>City</th>
                     <th>Cheque/Bank book Photo</th>
                     <th>Created Date</th>
                     <th>Updated</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @php $i = 1 @endphp
                  @foreach($users as $user )
                  <tr>
                     <td>{{$i}}</td>
                     <td><b>{{$user->user_name}}</b></td>
                     <td><b>{{$user->name}} / <span class="badge"> {{$user->user_key}} </span> </b>
                     <td><b>@isset($user->bankDetails->name){{$user->bankDetails->name}}@else NA @endisset</b>
                     <td><b>@isset($user->bankDetails->account_no){{$user->bankDetails->account_no}} @else NA @endisset</b>
                     <td><b>@isset($user->bankDetails->branch){{$user->bankDetails->branch}} @else NA @endisset</b>
                     <td><b>@isset($user->bankDetails->ifsc){{$user->bankDetails->ifsc}} @else NA @endisset</b>
                     <td><b>@isset($user->bankDetails->city){{$user->bankDetails->city}} @else NA @endisset</b>
                     <td>@isset($user->bankDetails->kyc_document)
                      <a href="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->bankDetails->kyc_document}}" target="_blank">
                       <img src="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->bankDetails->kyc_document}}" width="100px" height="100px" alt="Account Details">
                      </a> 
                      @else NA @endisset
                     </td>
                     <td>
                        @isset($user->bankDetails->created_at){{$user->bankDetails->created_at}}@else NA @endisset
                     </td>
                     <td>
                        @isset($user->bankDetails->updated_at){{$user->bankDetails->updated_at}}@else NA @endisset
                     </td>
                     
                     <td>
                     <a href="/admin/user/bank-kyc-status/{{$user->id}}/2" class="btn btn-success btn-xs"> Approve</a>
                     <a href="/admin/user/bank-kyc-status/{{$user->id}}/3" class="btn btn-danger btn-xs"> Reject</a>
                     <a href="/admin/user/bank-update-log/{{$user->user_key}}/{{$user->id}}" class="btn btn-warning btn-xs"> Log</a>
                  </td>
                  </tr>
                  @php $i++ @endphp
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