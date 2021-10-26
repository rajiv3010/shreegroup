@extends('layouts.user')
@section('title','Support')
@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>@yield('title') <a href="/support/history" class="btn btn-xs btn-info">List</a></h3>
              </div>

            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>@yield('title')</h2>
                  
                    <div class="clearfix"></div>
                  </div>
                     
                  <div class="x_content">

                    <form class="form-horizontal form-label-left" novalidate  role="form" method="POST" action="/support/store"  enctype="multipart/form-data">

                      @csrf
                        <input type="hidden" name="user_key"  value="{{ Auth::user()->user_key}}">
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Select Issue <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select name="support_type_id" class="form-control">
                                  <option value="0">Select Issue</option>
                                  @foreach($support_type as $value)
                                  <option value="{{$value->id}}">{{$value->name}}</option>
                                  @endforeach
                                  </select>
                            </div>
                        </div>
                  
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dob">Message<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea class="form-control" name="message"></textarea>
                          </div>
                        </div>


                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="document">File<span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="document" class="form-control" accept="image/x-png,image/gif,image/jpeg">
                          </div>
                        </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
@endsection