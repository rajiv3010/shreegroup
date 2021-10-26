@extends('layouts.admin')
@section('title','Approve KYC')
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
            <a href="/admin/user/approve-kyc/1" class="btn btn-success">Under Review</a>
            <a href="/admin/user/approve-kyc/0" class="btn btn-warning">Pending</a>
            <a href="/admin/user/approve-kyc/2" class="btn btn-primary">Accepted</a>
            <a href="/admin/user/approve-kyc/3" class="btn btn-danger">Rejected</a>
         </div>
         <!-- /.box-header -->
         <div class="box-body dataRow table-responsive" >
            <table id="example" class="dataTables table table-bordered table-striped ">
               <thead>
                  <tr>
                     <th>#</th>
                     <th>User Name</th>
                     <th>Name</th>
                     <th>Pan Number</th>
                     <th>PAN</th>
                     <th>Aadhar / Passport Number</th>
                     <th>Aadhar Card / Passport</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @php $i = 1 @endphp
                  @foreach($users as $user )
                  <tr>
                     <td>{{$i}}</td>
                     <td><b>{{$user->user_name}}</b></td>
                     <td><b>{{$user->name}}</b><br>({{$user->user_key}})</td>
                     <td>{{$user->pan}}</td>
                     <td>
                        <a href="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->pan_document}}" target="_blank">
                        <img src="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->pan_document}}" width="100px" height="100px" alt="PAN">
                        </a> <br>
                        @if($user->is_pan_verified==2)
                        <a  class="badge btn-success btn-xs"> Approved <i class="fa fa-check"></i>   </a>
                        @elseif($user->is_pan_verified==3)
                        <a class="badge btn-danger btn-xs"> Rejected <i class="fa fa-remove"></i></a>
                        @else
                        <a style="    display:  inline-table;" href="/admin/user/pan-status/{{$user->id}}/2" class="btn btn-success btn-xs"> Approve</a>
                        <a style="    display:  inline-table;" href="/admin/user/pan-status/{{$user->id}}/3" class="btn btn-danger btn-xs"> Reject</a>
                        @endif
                     </td>
                     <td>{{$user->aadhaar_no}}</td>
                     <td>
                        <br>
                        @if($user->is_adhaar_verified==2)
                        <a href="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->adhaar_front}}" target="_blank">
                        <img src="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->adhaar_front}}" width="100px" height="100px" alt="Aadhaar Card Front">
                        </a>
                        <a target="_blank" href="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->adhaar_back}}">
                        <img src="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->adhaar_back}}" width="100px" height="100px" alt="Aadhaar Card Back">
                        </a>
                        <a  class="badge btn-success btn-xs"> Approved <i class="fa fa-check"></i>   </a>
                        @elseif($user->is_adhaar_verified==3)
                        <a href="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->adhaar_front}}" target="_blank">
                        <img src="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->adhaar_front}}" width="100px" height="100px" alt="Aadhaar Card Front">
                        </a>
                        <a target="_blank" href="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->adhaar_back}}">
                        <img src="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->adhaar_back}}" width="100px" height="100px" alt="Aadhaar Card Back">
                        </a>
                        <a class="badge btn-danger btn-xs"> Rejected</a>
                        @elseif($user->is_adhaar_verified==0)
                        <a  class="badge btn-warning btn-xs"> Pending</a>
                        @else
                        <a href="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->adhaar_front}}" target="_blank">
                        <img src="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->adhaar_front}}" width="100px" height="100px" alt="Front">
                        </a>
                        <a target="_blank" href="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->adhaar_back}}">
                        <img src="{{env('base_url')}}assets/user/{{$user->id}}/documents/{{$user->adhaar_back}}" width="100px" height="100px" alt="Back">
                        </a>
                        <a style="    display:  inline-table;" href="/admin/user/aadhar-status/{{$user->id}}/2" class="btn btn-success btn-xs"> Approve</a>
                        <a style="    display:  inline-table;" href="/admin/user/aadhar-status/{{$user->id}}/3" class="btn btn-danger btn-xs"> Reject</a>
                        @endif
                     </td>
                     <td>
                        <a href="/admin/user/approvedKYC/{{$user->id}}/2" class="btn btn-success btn-xs"> Approve All</a>
                        <a href="/admin/user/approvedKYC/{{$user->id}}/3" class="btn btn-danger btn-xs"> Reject</a>
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