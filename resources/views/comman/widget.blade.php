<!-- row 3 -->
<div class="row"  >
<!-- col-md-8 -->
  <div class="col-md-8">
    <div class="row">
    <!-- Featured Ads -->
              <div class="col-md-6">
                <div class="box">
                        <div class="box-header with-border bg-yellow">
                          <h3 class="box-title">Featured Ads</h3>
                          
                        </div>
                <div class="box-body">
                          <table class="example  table table-bordered">
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Points</th>
                              <th>Action</th>       
                            </tr>
                            @php $i=1; @endphp
                            @foreach($advertisements as $advertisement)
                            <tr>
                              <td>{{$i}}</td>
                              <td>{{$advertisement->offer_name}}</td>
                              <td>{{$advertisement->points}}</td>
                              <td>
                              <form action="/admanagement/openLink" target="_blank" method="post">
                              {{csrf_field() }}
                              <input type="hidden" name="url" value="{{$advertisement->link}}">
                              <input type="hidden" name="advertisement_id" value="{{$advertisement->id}}">

                              <button type="submit" class="btn btn-xs btn-warning"  data-toggle="modal" data-target="#modal-default">Click</button>
                              </form>


                               </td>
                              
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                          </table>
                        </div>
                        <div class="box-footer clearfix">
                       
                        </div>

                      </div>
              </div>

<!-- /.modal -->
    <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ad Name</h4>
              </div>
              <div class="modal-body">
                <p>Description&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <a href="#"><button type="button" class="btn btn-success">Click</button></a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    <!-- Featured Ads -->


<!-- Hot Apps -->
              <!-- <div class="col-md-6">
                <div class="box">
                        <div class="box-header with-border bg-yellow">
                          <h3 class="box-title">HOT Applications</h3>
                          
                        </div>
                <div class="box-body">
                          <table class="table table-bordered">
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Name</th>
                              <th>Action</th>
                            </tr>
                            
                          
                           
                          </table>
                        </div>
                        
                
              </div>
            </div> -->


            <!-- /.modal -->
              <!-- <div class="modal fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Application Name</h4>
              </div>
              <div class="modal-body">
                <p>Description&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <a href="#"><button type="button" class="btn btn-success">Download</button></a>
              </div>
            </div>
          </div>
        </div> -->
        <!-- /.modal -->
<!-- Hot Apps -->
</div>

<div class="row">

<!-- top ten -->

            <div class="col-md-6">
                <div class="box">
                        <div class="box-header with-border bg-green">
                          <h3 class="box-title">Top 10 Earners</h3>
                          
                        </div>
                <div class="box-body">
                          <table class="table table-bordered">
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Name</th>
                              <th>Amount</th>
                              <th style="width: 40px;">Congrats Them</th>
                            </tr>
                            @php $i=1; @endphp
                              @foreach($topEarners as $topEarner)
                            <tr>
                              <td>{{$i}}</td>
                              <td>@if(isset($topEarner->user->name)) {{$topEarner->user->name}} @else NA @endif </td>
                              <td>{{round($topEarner->amount,2)}}</td>
                              <td><a href="/congrats/user/{{$topEarner->user_key}}"><i class="fa fa-thumbs-o-up"></i></a></td>
                            </tr>
                            @php $i++; @endphp
                            @endforeach
                          </table>
                        </div>
                       
                
              </div>
            </div>
<!-- top ten -->



  <!-- seminars -->
          <!-- <div class="col-md-6">
            <div class="box">

<div class="box-header bg-light-blue">
              <h3 class="box-title">Event</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>



                      <div class="box-body no-padding">
                        <table class="table table-hover">
                          <tr>
                            <th>Title</th>
                            <th>Place</th>
                            <th>Contact Person</th>
                            <th>Date</th>
                          </tr>
                          @foreach($seminars as $seminar)
                          <tr>
                            <td>{{$seminar->title}}</td>
                            <td>{{$seminar->place}}</td>
                            <td>{{$seminar->contact_person}}</td>
                            <td>{{$seminar->seminar_date}} : {{$seminar->time}}</td>
                         @endforeach
                          </tr>               
                        </table>
                      </div>
                      
                     
                    </div>
          </div> -->
          <!-- seminars -->









</div>

          </div>
<!-- col-md-8 -->


<!-- col-md-4 -->
<div class="col-md-4">






<!-- Offers -->

            <!-- <div class="col-md-12">
                <div class="box">
                        <div class="box-header with-border bg-green">
                          <h3 class="box-title">Offers</h3>
                          
                        </div>
                <div class="box-body">
                          <table class="table table-bordered">
                            <tr>
                              <th style="width: 10px">#</th>
                              <th>Offer</th>
                              <th>Reward</th>
                              <th>End Date</th>
                            </tr>

                          </table>
                        </div>
                        
                
              </div>
            </div> -->
<!-- Offers -->





          <!-- documents -->
         
                <!-- documents -->  
</div>
<!-- col-md-4 -->



<!-- row 3 -->

      

