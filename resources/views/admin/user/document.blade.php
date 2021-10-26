@extends('layouts.admin')
@section('title','User Document')
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

      <!-- row 2 -->
      <div class="row">

        <div class="col-xs-12 col-md-5 col-lg-5 col-sm-12">

        <!-- documents -->
          <div class="box">
            @if(Session::has('message'))
            <div  class="alert alert-success">
            <p>{{Session::get('message') }}</p>
            </div>
            @endif
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="example">
                <tr>

                  <th>Document</th>
                  <th>Status</th>
                  <th>View</th>
                  <th>Action</th>

                </tr>
               @foreach($documents as $document)
                <tr>
                  <td>{{$document->name}}</td>
                  <td>
                  @if(isset($document->user_documents->user_id))
                      @if($document->user_documents->status ==1)
                                        <span class="label label-success">Verified</span>
                      @elseif($document->user_documents->status ==2)
                                        <span class="label label-danger">Not Valid</span>
                      @else
                                        <span class="label label-info">Review</span>
                      @endif
                  @else
                     <span class="label label-warning">Pending</span>
                  @endif


                  </td>
                  <td>
                     @if(isset($document->user_documents->user_id))
                      <a href="/public/assets/user//document/{{$document->user_documents->attachment_temp}}">Open File</a>
                     @endif

                  </td>
                  <td>  @if(isset($document->user_documents->user_id))
                        @if(isset($document->user_documents->user_id))
                            @if($document->user_documents->status ==1)
                                <span class="label label-success">Verified</span>
                            @elseif($document->user_documents->status ==2)
                                        <span class="label label-danger">Not Valid</span>
                            @else
                            <span class="label label-info">Review</span>

                            @endif


                            @else
                            <span class="label label-warning">Pending</span>
                            @endif
                            | <a href="/admin/user/documents/status/1/{{$document->user_documents->user_id}}/{{$document->id}}">  <i class="fa fa-check" aria-hidden="true" title="Verified"></i></a>
                            |
                             <a href="/admin/user/documents/status/2/{{$document->user_documents->user_id}}/{{$document->id}}"><i class="fa fa-times" aria-hidden="true" title="Not Verified"></i></a>

                        @else
                          -
                        @endif



                </tr>
               @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- documents -->


        </div>
      </div>
      <!-- row -2 -->





        </section>
        <!-- right col -->
      </div>
  @endsection
