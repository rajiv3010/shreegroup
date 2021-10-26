@extends('layouts.email')
@section('content')
<p>Hello {{$user->name}} </p>
You recently asked to reset your {{env('company_name')}} account password.<br>
<a href="{{URL::to('/')}}/user/passwordresetLink/{{$token}}">Click here </a> or copy the token to reset your password. 
<br>
<a href="{{URL::to('/')}}/user/passwordresetLink/{{$token}}">{{URL::to('/')}}/user/passwordresetLink/{{$token}}</a>

@endsection