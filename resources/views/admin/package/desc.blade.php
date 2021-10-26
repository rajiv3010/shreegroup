@extends('layouts.admin')
@section('title','Package Description')
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
      <!-- /.row 1 - small boxes -->
      <!-- form -->

      <!-- form -->
      <!-- list start -->
      <div class="box box-body box-success table-responsive" >
         <!-- form start --><a href="/admin/p/description/add" class="btn btn-info btn-sm" style="margin-bottom: 5px;">Add</a>
         <table id="example" class="table table-responsive table-bordered table-striped">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Quantity</th>
                  <th>Edit</th>
               </tr>
            </thead>
            <tbody>
               @php $i=1; @endphp
               @foreach($package_descs as $package_desc)
               <tr>
                  <td>{{$i}}</td>
                  <td>@if(isset($package_desc->package->name))
                        {{$package_desc->package->name}}
                        @endif
                     </td>
                  <td>{!! $package_desc->description !!}</td>
                    <td> 
                  <a href="/admin/p/description/edit/{{$package_desc->id}}" class="btn btn-sm btn-default">Edit</a></td>

               </tr>
               @php $i++; @endphp      
               @endforeach
            </tbody>
         </table>
      </div>
      </section>
      <!-- list start -->
</div>

   
   <!-- /.box-body -->
@endsection