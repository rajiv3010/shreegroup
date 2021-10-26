@extends('layouts.user')
@section('title','Dashboard')
@section('content')

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Support
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
            <!-- /.row 1 - small boxes-->
      <div class="row">
        <div class="col-lg-12">
          <!-- DIRECT CHAT PRIMARY -->
          <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Chat Box</h3>

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
                    <span class="direct-chat-timestamp pull-left">{{date('d M H:i',strtotime($chat->created_at))}}</span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text pull-left">
                      {{$chat->message}}
                  </div>

                  <!-- /.direct-chat-text -->
                </div>
                    <span class="direct-chat-name pull-left">{{$chat->admin->name}}</span>

                @endif
                <!-- /.direct-chat-msg -->
                @if($chat->type=='user')
                <div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-timestamp pull-right"> |  {{date('d M H:i',strtotime($chat->created_at))}}</span>
                    <span class="direct-chat-name pull-right">{{$chat->user->name}}</span>

                  </div>
                  <!-- /.direct-chat-info -->
                  @if($chat->user->profile_photo)
                  <img class="direct-chat-img" src="{{env('base_url')}}assets/user/{{$chat->user->id}}/profile/{{$chat->user->profile_photo}}" alt="{{$chat->user->name}}"><!-- /.direct-chat-img -->
                  @else
                  <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="User Profile Pic">
                  @endif
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
              <form action="/support/chating" method="post">
                {{ csrf_field() }}
                <div class="input-group">
                  <input type="hidden" name="admin_id" value="{{$chats[0]->admin_id}}">
                  <input type="hidden" name="type" value="user">
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