@extends('layouts.user')
@section('title','Dashboard')
@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Your registration proccess completed</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                        <div class="col-md-4 col-sm-3 col-xs-12">
                          <div class="x_panel">
                            <div class="x_content">
                              <p>Name: <span class="bold">{{Auth::user()->name}}</span></p>
                              <p>User ID: <span class="bold">{{Auth::user()->user_key}}</span></p>
                              <p>Email: <span class="bold">{{Auth::user()->email}}</span></p>
                              <p>Phone: <span class="bold">{{Auth::user()->mobile}}</span></p>
                              <p>Password: <span class="bold">{{Auth::user()->admin_password}}</span></p>
                            </div>
                          </div>
                        </div>
                        
                       <!--  -->
                       
                    </div>
                  </div>
                </div>
              </div>
            </div>

           
              </div>
                        
            </div>

            


          
          </div>
        </div>
        <!-- /page content -->
  @endsection