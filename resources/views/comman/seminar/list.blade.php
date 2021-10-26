@extends('layouts.app')
@section('title','Dashboard')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Ads Management
  <small></small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dashboard</li>
  </ol>
</section>
  <!-- Main content -->
  <section class="content">
      <!-- /.row 1 - small boxes -->
      <div class="box">
          <div class="box-header">
          <a href="/admin/content-manager/seminar/add" class="small-box-footer">
            <span class="pull-left-container">
                  <small class="label pull-left bg-green"><i class="fa fa-plus"></i> new</small>
            </span>
            </a>
          </div>
          <!-- /.box-header -->
            <div class="row">
                <div class="container">
                    <div class="col-md-6">
                        
                    @if(Session::has('message'))
                    <div  class="alert alert-success">
                    <p>{{Session::get('message') }}</p>
                    </div>
                    @endif
                    </div>

                </div>
            </div>
                <div class="row docs-premium-template">
            @foreach($seminars as $seminar)
                    <div class="col-sm-12 col-md-6">
                    <div class="box box-solid" style="background-color: #59739a;color: #ffffff">
                    <div class="box-body">
                        <h4 style="background-color:#222b3a; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                           {{$seminar->title}}
                        </h4>
                        <div class="media">
                            <div class="media-left">
                                
                                    <img src="{{env('base_url')}}/assets/seminar/{{$seminar->image}}" alt="TDM" class="media-object" style="width: 150px;height: auto;border-radius: 4px;box-shadow: 0 1px 3px rgba(0,0,0,.15);">
                                
                            </div>
                            <div class="media-body">
                                <div class="clearfix">
                                   Contact person : <strong>{{$seminar->contact_person}}</strong>
                                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> Address:         {{$seminar->place}}</p>
                                    <p style="margin-bottom: 0">
                                       <i class="fa fa-calendar-check-o" aria-hidden="true"></i>Seminar Date :  <strong>{{$seminar->seminar_date}} : {{$seminar->time}}</strong>
                                    </p>
                                    <p>

                                    <p>Description :  <strong>{{$seminar->description}}</strong></p>
                                    @if(Auth::guest()) 
                                      <p>Action:  <a href="/admin/content-manager/seminar/status/1/{{$seminar->id}}">  <i class="fa fa-check" aria-hidden="true" title="Verified"></i></a>
                                        |
                                         <a href="/admin/content-manager/seminar/status/0/{{$seminar->id}}"><i class="fa fa-times" aria-hidden="true" title="Not Verified"></i></a>
                                          |
                                        <a href="/admin/content-manager/seminar/remove/{{$seminar->id}}">
                                                 <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>
                                          <p>Status :  <strong>@if($seminar->status) Publish @else Draft @endif</strong></p>
                                       
                                     @else 
                                         <p>Status :  <strong>@if($seminar->status) Publish @else Draft @endif</strong></p>

                                     @endif
                                   
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{$seminars->links()}}
            </div>
    
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection