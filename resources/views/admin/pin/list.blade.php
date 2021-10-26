@extends('layouts.admin')
@section('title','Pin List')
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
      <!-- /.row 1 - small boxes -->
      <div class="box">
          <div class="box-header">
            <div class="form-group">
              <div class="col-lg-1">
              Filters
            </div>
              <div class="col-lg-3">
            <select class="form-control filter-pin" id="status">
              <option @if($status=="all")selected="select" @else @endif  value="all">All</option>
              <option @if($status==0)selected="select" @else @endif  value="0">Used</option>
              <option @if($status==1)selected="select" @else @endif  value="1">Active</option>
              <option @if($status==2)selected="select" @else @endif  value="2">Allotted</option>
            </select>
                
              </div>
              <div class="col-lg-3">
            <select class="form-control filter-pin" id="package_id">
              <option value="all">All</option>
              @foreach($packages as $package)
              <option @if($package_id==$package->id)selected="select" @else @endif value="{{$package->id}}">{{$package->name}}</option>
              @endforeach
            </select>
                
              </div>
            </div>

       
          </div>
          <!-- /.box-header -->
			@if(Session::has('message'))
			<div class="alert alert-success">
					<p>{{Session::get('message') }}</p>
			</div>
			@endif
            <div class="box-body dataRow">
      <div class="col-lg-4">
        
              <!-- <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                  <th>Status</th>
                  <th>Count</th>

                  <th>Action</th>
                  </tr>
                  <tbody>
                    @foreach($statusList as $sList)
                    <tr>
                      <td>
                        @if($sList->status==0)
                          Used
                        @elseif($sList->status==1)
                          Active
                        @elseif($sList->status==2)
                          Allotted
                        @else

                        @endif
                      </td>
                      <td>{{$sList->count}}</td>
                      <td>@if($sList->status==1 || $sList->status==2)<a href="/admin/pin/remove/status-pins/{{$sList->status}}">Remove all pins</a>@endif</td>
                    </tr>
                    @endforeach
                    <tr>
                      <td>Total</td>
                      <td>{{$count}}</td>
                    </tr>
                  </tbody>
              </thead>
              </table> -->
      </div>              
              <table id="example1" class="table table-bordered table-striped">
              <thead>
                  <tr>
                  <th>#</th>
                  <th>Package Name</th>
                  <th>Pin</th>
                  <th>Amount</th>
                  <th>Allotted To</th>
                  <th>Used By</th>
                  <th>Status</th>
                  <th>Used At</th>
                  <th>Date</th>
                  <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @php $i = 1 @endphp
                  @foreach($pins as $pin)
                      <tr>
                      <td>{{$i}}</td>
                      <td> @if(isset($pin->package->name)){{$pin->package->name}} @endif</td>
                      <td>{{$pin->pin_number}}</td>
                      <td>{{$pin->package->amount}}</td>
                      <td>
                         @if(isset($pin->allottedPinTo->name))
                          {{$pin->pin_owner}}/ {{$pin->allottedPinTo->name}}
                          @endif
                      </td>
                      <td>  
                            @if(isset($pin->usedBy->name)){{$pin->usedBy->name}} / {{$pin->usedBy->user_key}} @endif  </td>


 
                      <td>@if($pin->status==1)

                           Active @elseif($pin->status==0)
                                   Used
                              @elseif($pin->status==2)

                                   Allotted to
                                   @if(isset($pin->allottedPinTo->name))
                                   {{$pin->allottedPinTo->name}}
                                   @endif

                            @else - @endif</td>
                      <td>@if($pin->used_at==null)
                        @else
                        {{date('d M,Y',strtotime($pin->used_at))}}
                      @endif
                    </td>
                      <td>{{date('d M,Y H:s',strtotime($pin->created_at))}}</td>

                        <td>
                          @if($pin->status==4)
                          <a href="/admin/pin/block/{{$pin->id}}/1">
                              <i class="fa fa-check alert-success"></i>
                          </a>
                          @elseif($pin->status==1 || $pin->status==2)
                            <a href="/admin/pin/block/{{$pin->id}}/4" class="btn btn-xs btn-danger">
                              <i class="fa fa-ban"> Block</i>
                          </a>
                          @endif
                          
                          
                          @if($pin->status==1 || $pin->status==2)
                          <a href="/admin/pin/remove/{{$pin->id}}" class="btn btn-xs btn-warning">
                          <i class="fa fa-remove"> Remove</i> 
                          </a>
                            @endif
                        </td>
                      </tr>
                  @php $i++ @endphp
                  @endforeach
                 
      
              </tbody>
              </table>
               {{ $pins->appends(['status' => $status,'package_id'=>$package_id])->links()}}
          </div>
          
          </div>
        </section>
      </div>

  <!-- /.box-body -->
  @endsection