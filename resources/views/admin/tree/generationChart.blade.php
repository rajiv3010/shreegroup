@extends('layouts.admin')
@section('title','Generation Chart')
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

        <div class="panel-body">
              <h2>{{Auth::user()->name}}</h2>
              
            <div class="tree">
           {!! $trees !!}
            </div>
        </div>
    </div>
     @endsection 
