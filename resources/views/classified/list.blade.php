@extends('layouts.app')
@section('title','Classified')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
Classified
  <small></small>
  </h1>
  <ol class="breadcrumb">
  <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Classified</li>
  </ol>
</section>
  <!-- Main content -->
  <section class="content">
      <!-- /.row 1 - small boxes -->
          <div class="box-header">
          <a href="/classified/add" class="small-box-footer">
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
            @foreach($classifieds as $classified)
                    <div class="col-sm-12 col-md-4">
                    <div class="box box-solid">
                    <div class="box-body">
                        <h4 style="background-color:#222b3a;color: #FFF; font-size: 18px; text-align: center; padding: 7px 10px; margin-top: 0;">
                            {{$classified->company_name}}
                        </h4>
                        <div class="media">
                            <div class="media-left">
                                    <img src="@if($classified->logo){{$classified->logo}}@else /images/logo.png @endif" alt="{{$classified->company_name}}" class="media-object" style="max-width: 150px; max-height: 115px ;height: auto;border-radius: 4px; border: 2px solid white; padding: 20px;">
                               
                            </div>




                            <div class="media-body">
                                <div class="clearfix">
                                   Type :<strong> {{$classified->category->name}}</strong><br>
                                    <small style="color: #red;">Company ID : {{$classified->customer_id}}</small><br>
                                    <small>Managed By :  <strong>{{$classified->first_name}} {{$classified->last_name}}</strong></small><br>
                                    <small data-toggle="tooltip" title="address"><i class="fa fa-map-marker" aria-hidden="true"></i> : @if($classified->address) {{ substr( $classified->address,0,40)}}... @else NA @endif </small><br>
                                    <small><i class="fa fa-calendar-check-o" aria-hidden="true"></i> :  <strong>{{ date('Y-m-d',strtotime($classified->created_at))}}</strong></small><br>

                                    @if(Auth::guest()) 
                                    <p>Action:  <a href="/admin/content-manager/classified/status/1/{{$classified->id}}">  <i class="fa fa-check" aria-hidden="true" title="Verified"></i></a>
                                    |
                                    <a href="/admin/content-manager/classified/status/0/{{$classified->id}}"><i class="fa fa-times" aria-hidden="true" title="Not Verified"></i></a>
                                    |
                                    <a href="/admin/classified/remove/{{$classified->id}}">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                    <p>Status : <strong>@if($classified->status) Publish @else Draft |  <a href="/classified/edit/{{$classified->id}}"><i class="fa fa-edit"></i></a>   @endif</strong></p>
                                    @else 
                                    <p>Status : <strong>@if($classified->status) Publish @else Draft | <a href="/classified/edit/{{$classified->id}}"><i class="fa fa-edit"></i></a> @endif</strong></p>
                                    </p>
                                    @endif
                                    
                                </div>
                            </div>


                            
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{$classifieds->links()}}
            </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection