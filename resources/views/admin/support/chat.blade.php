@extends('layouts.admin')
@section('title','Support')
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
      <!-- Small boxes (Stat box) -->
            <!-- /.row 1 - small boxes-->
      <div class="row">
        <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

              
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    @foreach($users as $user)
                    @if(isset($user->user->id))
                    <li>
                          @if($user->user->profile_photo)
                  <img class="direct-chat-img" src="{{env('base_url')}}assets/user/{{$user->user->id}}/profile/{{$user->user->profile_photo}}" alt="{{$user->user->name}}"><!-- /.direct-chat-img -->
                  @else
                  <img class="direct-chat-img" src="/dist/img/user1-128x128.jpg" alt="User Profile Pic">
                  @endif
                      <a class="users-list-name" href="/admin/support/chat/{{$user->user_key}}">{{$user->user->name}}</a>
                      <span class="users-list-date">{{$user->user->user_key}}</span>
                    </li>
                    @endif
                    @endforeach

                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
        <div class="col-lg-6">
          <!-- DIRECT CHAT PRIMARY -->
          <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Support Chat</h3>

              <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="3 New Messages">3</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
               
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages">
                <!-- Message. Default to the left -->

                @foreach($chats as $chat)
                @if($chat->type=='admin')
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">{{$chat->admin->name}}</span>
                    <span class="direct-chat-timestamp pull-left">{{date('d M H:i',strtotime($chat->created_at))}}</span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="/dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text pull-left">
                      {{$chat->message}}
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                @endif
                <!-- /.direct-chat-msg -->
                @if($chat->type=='user')
                <div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">{{$chat->user->name}}</span>
                    <span class="direct-chat-timestamp pull-right">{{date('d M H:i',strtotime($chat->created_at))}}</span>
                  </div>
                  <!-- /.direct-chat-info -->
                     @if($chat->user->profile_photo)
                  <img class="direct-chat-img" src="{{env('base_url')}}assets/user/{{$chat->user->id}}/profile/{{$chat->user->profile_photo}}" alt="{{$chat->user->name}}"><!-- /.direct-chat-img -->
                  @else
                  <img class="direct-chat-img" src="/dist/img/user1-128x128.jpg" alt="User Profile Pic">
                  @endif<!-- /.direct-chat-img  -->
                  <div class="direct-chat-text pull-right">
                      {{$chat->message}}
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                @endif

                @endforeach
                <!-- Message to the right -->
                




                <!-- /.direct-chat-msg -->
              </div>
              <!--/.direct-chat-messages-->
             </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <form action="/admin/support/chating" method="post">
                {{ csrf_field() }}
                <div class="input-group">
                  @if(isset($chats[0]->user_key))
                  <input type="hidden" name="user_key" value="{{$chats[0]->user_key}}">
                  @endif
                  <input type="hidden" name="type" value="admin">
                  <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-flat">Send</button>
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
          <!--/.direct-chat -->
        </div>
        <!-- /.col -->

      </div>

          <!-- Row 2 - Graph -->

        </section>
        <!-- right col -->
      </div>
  @endsection