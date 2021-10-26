@extends('layouts.admin')
@section('title','User Bank History')
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
                     <th>#</th>
                     <th>Name</th>
                     <th>Bank Name</th>
                     <th>Account number</th>
                     <th>Branch Name</th>
                     <th>IFSC Code</th>
                     <th>City</th>
                     <th>Cheque Copy</th>
                     <th>Created Date</th>
                     <th>Updated</th>
                  </tr>
               </thead>
               <tbody>
                  @php $i = 1 @endphp
                  @foreach($users as $user)
                  <tr>
                     <td>{{$i}}</td>
                     <td><b>{{$user->user_key}}</b>
                     <td><b>{{$user->name}}</b>
                     <td><b>{{$user->account_no}}</b>
                     <td><b>{{$user->branch}}</b>
                     <td><b>{{$user->ifsc}}</b>
                     <td><b>{{$user->city}}</b>
                     <td>
                      <a href="{{env('base_url')}}assets/user/{{$user_id}}/documents/{{$user->kyc_document}}" target="_blank">
                           
                       <img src="{{env('base_url')}}assets/user/{{$user_id}}/documents/{{$user->kyc_document}}" width="100px" height="100px" alt="Cheque Copy">
                      </a> 
                     </td>


                     <td>
                        {{$user->created_at}}
                     </td>
                     <td>
                        {{$user->updated_at}}
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