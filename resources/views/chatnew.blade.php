<!DOCTYPE html>
<html>
<head>
    <title>Real-Time Laravel with Pusher</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <base href="{{asset('')}}">
    <script src="js/chat.js"></script>
</head>
<body>
<div class="panel panel-primary chat">
    <div class="panel-heading">
        <i class="fa fa-user" aria-hidden="true"></i>
        {{ Auth::user()->name }}
    </div>
    <div class="box-chat">
        <div class="user">
            <span class="message">alo</span>
            <br>
            <span class="author-message"><b>Manager</b></span>
        </div>
    </div>
    <div class="panel-footer clearfix">
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control message-content" placeholder="Type your message">
                <input type="hidden" class="room-id" value="1">
                <input type="hidden" class="user-id" value="{{ Auth::id() }}">
                <div class="input-group-addon">
                    <a href="#" id="interview-message-send" data-url="#">
                        Send Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>