@extends('layouts.email')
@section('content')
<p>Hello {{$data->first_name}} </p>

Dear {{$data->first_name}},<br>

	{{$data->message}}

@endsection