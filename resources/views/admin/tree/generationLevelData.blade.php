@forelse($data as $key=>$value)

<tr>
<td>{{$key+1}}</td>
<td>{{$value->user_key}} | <span class="badge badge-success">{{$value->level}}</span></td>
<td>{{$value->name}}</td>
<td>{{$value->package_activate_date}}</td>
</tr>
@empty
<tr>
<td colspan="4"><h5>No User Found</h5></td>
</tr>
@endforelse
