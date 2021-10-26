  <h3>Count New: {{$count}}</h3>
            
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
                          {{$pin->pin_owner}}/ {{$pin->allottedPinTo->name}}
                      </td>
                      <td>  
                            @if(isset($pin->usedBy->name)){{$pin->usedBy->name}} / {{$pin->usedBy->user_key}} @endif  </td>


 
                      <td>@if($pin->status==1) Active @elseif($pin->status==0) Used  @elseif($pin->status==2) 
                                   Allotted to

                                   {{$pin->allottedPinTo->name}}

                                    @else -@endif</td>
                      <td>@if($pin->used_at==null)
                        @else
                        {{date('d M,Y',strtotime($pin->used_at))}}
                      @endif
                    </td>
                      <td>{{date('d M,Y H:s',strtotime($pin->created_at))}}</td>
                      </tr>
                  @php $i++ @endphp
                  @endforeach
                 
      
              </tbody>
              </table>
               {{ $pins->appends(['status' => $status,'package_id'=>$package_id])->links()}}

                     <script type="text/javascript">
         $(document).ready( function () {
    $('table').DataTable({
       "paging":   false
    });
} );
      </script>