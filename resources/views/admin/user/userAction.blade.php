	<a href="/admin/user/edit/{{$row->id}}" class="btn btn-success btn-xs"> Edit</a>
	<a href="/associate/doLogin/{{$row->user_key}}" target="_blank"  class="btn btn-success btn-xs"> Login</a>
	<a href="/admin/content-manager/dispatch-entry/{{$row->user_key}}" target="_blank"  class="btn btn-success btn-xs"> Dispatch</a>


	@if($row->banned)
	<a href="/admin/user/banned/{{$row->id}}/0" class="btn btn-danger btn-xs"> Block</a>
	@else
	<a href="/admin/user/banned/{{$row->id}}/1" class="btn btn-success btn-xs"> UnBlock</a>
	@endif