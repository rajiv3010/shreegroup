@extends('layouts.app')
@section('title','Dashboard')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Document Upload for Portal users
        <small>Report</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     @if(Session::has('message'))
            <div  class="alert alert-success">
            <p>{{Session::get('message') }}</p>
            </div>
            @endif

      <!-- Small boxes (Stat box) -->
       @if(Auth::guest())
       
       
       <div class="box box-warning">
       <div class="box-body">
       
          {!! Form::open(['url' => '/admin/content-manager/documents/upload','enctype'=>'multipart/form-data']) !!}
            <div class="row">
                <div class="form-group col-lg-3">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control" required="required">
                </div>
                <div class="form-group col-lg-3">
                  <label>Upload Document</label>
                  <input type="file" name="document" required="required">
                </div>
                </div>
                <div class="row" align="center">
                <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success">Submit</button></div>
                </div>
      {!! Form::close() !!}
            </div>
            </div>
       @else

       @endif
                
             

      <div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Document</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($documents as $document)
                  <tr>
                    <td>{{$document->title}}</td>
                    <td>
                    @if($document->document_type =='jpg' ||$document->document_type =='png' || $document->document_type =='jpeg')
                   <a  href="/admin/content-manager/documents/DownloadAttachment/{{$document->id}}">
                           <img width="40px" src="{{env('base_url')}}icons/img.png">
                   </a>
                   @elseif($document->document_type =='pdf')
                   <a  href="/admin/content-manager/documents/DownloadAttachment/{{$document->id}}">
                           <img width="40px" src="{{env('base_url')}}icons/pdf.png">
                   </a>
                   @elseif($document->document_type =='excel'|| $document->document_type =='xlsx')
                   <a  href="/admin/content-manager/documents/DownloadAttachment/{{$document->id}}">
                           <img width="40px" src="{{env('base_url')}}icons/excel.png">
                   </a>
                   @elseif($document->document_type =='word' || $document->document_type =='doc' || $document->document_type =='docs' || $document->document_type =='txt')
                   <a  href="/admin/content-manager/documents/DownloadAttachment/{{$document->id}}">
                           <img width="40px" src="{{env('base_url')}}icons/doc.png">
                   </a>
                    @endif
                    </td>
                    <td>{{ date('d ,M Y',strtotime($document->created_at))}}</td>
                    <td> <a href="/admin/content-manager/documents/remove/{{$document->id}}"> <i class="fa fa-trash"></i></a></td>
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