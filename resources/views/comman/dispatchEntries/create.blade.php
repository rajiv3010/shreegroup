@if(Auth::guard('admin')->user()->id)
@extends('layouts.admin')
@else
@extends('layouts.app')
@endif
@section('title','Dashboard')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New Seminar
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li >Seminar</li>
        <li class="active">add new</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
            <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Add Seminar details</h3>
            </div>
            <!-- /.box-header -->
          <div class="box-body">
    {!! Form::open(['url' => '/admin/content-manager/seminar/save','enctype'=>'multipart/form-data']) !!}
                <div class="row">
                <div class="form-group col-lg-6">
                  <label>Title</label>
                  <input type="text" name="title" value="{{old('title')}}"  class="form-control" placeholder="Enter seminar title">
                </div>
                <div class="form-group col-lg-6">
                  <label>Description</label>
                  <input type="text" name="description" value="{{old('description')}}" class="form-control" placeholder="Enter seminar description">
                </div>
                <div class="form-group col-lg-6">
                  <label>Seminar Time</label>
                  <input type="time" name="time" value="{{old('offer_id')}}" class="form-control"   placeholder="Enter ...">
                </div>
                <div class="form-group col-lg-6">
                  <label>Seminar Place</label>
                  <input type="text" name="place" value="{{old('place')}}" class="form-control" placeholder="Enter Place">
                </div>


                <div class="form-group col-lg-6">
                  <label>Image</label>
                  <input type="file" name="image" class="form-control" placeholder="Enter ...">
                </div>
                <div class="form-group col-lg-6">
                  <label>Contact person</label>
                  <input type="text" name="contact_person" value="{{old('contact_person')}}" class="form-control" placeholder="Enter Contact Person">
                </div>

                <div class="form-group col-lg-6">
                  <label>Seminar  Date</label>
                  <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" name="seminar_date" class="form-control pull-right" id="datepicker">
                </div>
                </div>
                </div>
                <div class="row" align="center">
                <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success">Add</button></div>
                <div class="col-lg-3"><button type="button" class="btn btn-block btn-danger">Reset</button></div>

                </div>
      {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
          </div>

  </section>
        <!-- right col -->
      </div>
  @endsection
