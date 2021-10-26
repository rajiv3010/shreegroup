@extends('layouts.user')
@section('title','Wallet trasnfer to ID')
@section('content')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Wallet transfer to ID</h3>
              </div>

            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Transfer <small> Form</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                     {!! Form::open(['url' => '/pin/store','enctype'=>'multipart/form-data']) !!}
            <div class="row">
                <div class="form-group col-lg-6">
                  <label>User ID</label>
                  <input type="number" name="user_key" value="{{old('user_key')}}" class="form-control" placeholder="User ID">
                </div>
                <input type="hidden" name="user_key" value="{{Auth::user()->user_key}}">
                <div class="form-group col-lg-6">
                  <label>Amount</label>
                  <input type="number"  name="amount" value="{{old('amount')}}" class="form-control" placeholder="Enter Amount">
                </div>
                </div>
                <div class="row" align="center">
                <div class="col-lg-3"><button type="submit" class="btn btn-block btn-success">Submit</button></div>
                <div class="col-lg-3"><button type="button" class="btn btn-block btn-danger">Reset</button></div>
                </div>
      
      {!! Form::close() !!}
                   
                  </div>
                </div>
              </div>
            </div>



                <div class="x_panel">
                  <div class="x_title">
                    <h2>Transfer<small> History</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
          
                    <div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                      <div class="row">
                        <div class="col-sm-12">
                          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">

                      <thead>
                        <tr role="row">
                          <th>#</th>
                          <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Date: activate to sort column descending">Date</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1"  aria-label="Member ID: activate to sort column ascending">Member ID</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Name: activate to sort column ascending">Name</th>
                          <th class="sorting" tabindex="0" aria-controls="datatable-responsive" rowspan="1" colspan="1" style="width: 0px;" aria-label="Amount: activate to sort column ascending">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>xx/xx/xxxx</td>
                          <td>xxxxxx</td>
                          <td>xxxxxxxx</td>
                          <td>xxxxxxxx</td>
                          <td>₹xxx/-</td>
                        </tr>

              </tbody>
                    </table>
                  </div>
                 </div>
               </div>
              </div>
             </div>






          </div>
        </div>
        <!-- /page content -->
@endsection