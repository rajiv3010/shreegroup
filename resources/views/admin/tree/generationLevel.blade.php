@extends('layouts.user')
@section('title','Generation Level')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="title_left">
            <h3>@yield('title') </h3>
         </div>
      </div>
      <div class="clearfix"></div>
      <div class="">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_title">
                  <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->user_key}}">
                  <h2>{{Auth::user()->name}}'s @yield('title') <small><a href="{{ URL::previous() }}" class="btn btn-xs btn-success"><i class="fa fa-backward"></i> Back</a></small></h2>
                  <div class="clearfix"></div>
               </div>
               <!-- /.box-body -->
               <!-- /.box-footer -->
               <div class="x_content">
                  <!-- /.box-header -->
                  <div align="center" style="height: auto; background-color: black; padding: 10px; overflow: hidden; margin-bottom: 20px; text-align: center;">
                     <!-- /.box-header -->
                     <div>
                        @for($i=1;$i<=20;$i++)
                        <div data-user-level="{{$i}}" class="col-md-1 col-sm-1 col-xs-1 btn btn-default btn-xs generationLevelC" style="margin: 4px;">{{$i}}</div>
                        @endfor
                        <!-- /.users-list -->
                     </div>
                     <!-- /.box-body -->
                     <!-- /.box-footer -->
                  </div>
                  <h3 class="box-title">User list in level : <strong id="clevel"></strong></h3>
                  <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                     <div class="row">
                        <div class="col-sm-12">
                           <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                              <thead>
                                 <tr>
                                    <th>#</th>
                                    <th>User Key</th>
                                    <th>User Name</th>
                                    <th>Created at</th>
                                 </tr>
                              </thead>
                              <tbody id="gld">                  
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
      <div class="clearfix"></div>
   </div>
   <div class="clearfix"></div>
</div>
<!-- /page content -->
@endsection