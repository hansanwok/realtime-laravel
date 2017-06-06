<!DOCTYPE html>
<html>
<head>
    <title>Real-Time Laravel with Pusher</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <base href="{{asset('')}}">
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,200italic,300italic"
          rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="http://d3dhju7igb20wy.cloudfront.net/assets/0-4-0/all-the-things.css"/>
    <style>
        .chat-app {
            margin: 50px;
            padding-top: 10px;
        }

        .chat-app .message:first-child {
            margin-top: 15px;
        }

        #messages {
            height: 300px;
            overflow: auto;
            padding-top: 5px;
        }

        .message-body {
            background-color: #f1eff1;
            display: inline-block;
            border-radius: 3px;
        }
    </style>

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://cdn.rawgit.com/samsonjs/strftime/master/strftime-min.js"></script>
    <script src="//js.pusher.com/4.0/pusher.min.js"></script>

    <script>
        // Ensure CSRF token is sent with AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Added Pusher logging
        Pusher.log = function (msg) {
            console.log(msg);
        };
    </script>
</head>
<body>

<?php
//Dom de php -> javascript
$id_user = Auth::User()->id;
?>
<input type="hidden" value="{{$id_user}}" id="pass">
<div class="stripe no-padding-bottom numbered-stripe">
    <div class="fixed wrapper">
        <ol class="strong" start="2">
            <li>
                <div class="hexagon"></div>
                <h2><b>Real-Time Chat</b>
                    <small>Fundamental real-time communication.</small>
                </h2>
            </li>
        </ol>
    </div>
</div>

<section class="blue-gradient-background">
    <div class="container">
        <div class="row light-grey-blue-background chat-app">

            <div id="messages">
                <div class="time-divide">
                    <span class="date">Today</span>
                </div>
                    {{-- return 4 last chat php--}}
                    @if($last)
                        @foreach($last as $row):
                        @if($row->idUser == $id_user)
                            <div class="message">
                                <div class="avatar" style="float: right;">
                                    <img src="upload/avt/{{$row->user->avt}}">
                                </div>
                                <div class="text-display">
                                    <div class="message-data">
                                        <span class="author"
                                              style="font-weight: 700; float: right">{{$row->user->name}}</span>
                                        <span class="timestamp" style="float:right;">{{$row->created_at}}</span>
                                        {{--    <span class="seen"></span>--}}
                                    </div>
                                    <p class="message-body" style="background-color: #417fff;
            float: right;
            clear:both;
            color:white;
            display: inline-block;
            border-radius: 3px;">{{$row->text}}</p>
                                </div>
                            </div>
                   @else
                    <div class="message">
                        <div class="avatar">
                            <img src="upload/avt/{{$row->user->avt}}">
                        </div>
                        <div class="text-display">
                            <div class="message-data">
                                <span class="author" style="font-weight: 700">{{$row->user->name}}</span>
                                <span class="timestamp">{{$row->created_at}}</span>
                                {{-- <span class="seen"></span>--}}
                            </div>
                            <p class="message-body">{{$row->text}}</p>
                        </div>
                    </div>
                @endif
                @endforeach
                @endif
                {{-- end return 4 last chat php--}}
    </div>

    <div class="action-bar">
        <textarea class="input-message col-xs-10" placeholder="Your message"></textarea>
        <div class="option col-xs-1 white-background">
            <span class="fa fa-smile-o light-grey"></span>
        </div>
        <div class="option col-xs-1 green-background send-message">
            <span class="white light fa fa-paper-plane-o"></span>
        </div>
    </div>
</div>
    </div>
</section>

<script id="chat_message_template_to" type="text/template">
    <div class="message">
        <div class="avatar">
            <img src="">
        </div>
        <div class="text-display">
            <div class="message-data">
                <span class="author" style="font-weight: 700"></span>
                <span class="timestamp"></span>
                {{-- <span class="seen"></span>--}}
            </div>
            <p class="message-body"></p>
        </div>
    </div>
</script>


<script id="chat_message_template_from" type="text/template">
    <div class="message">
        <div class="avatar" style="float: right;">
            <img src="">
        </div>
        <div class="text-display">
            <div class="message-data">
                <span class="author" style="font-weight: 700; float: right"></span>
                <span class="timestamp" style="float:right;"></span>
                {{--    <span class="seen"></span>--}}
            </div>
            <p class="message-body" style="background-color: #417fff;
            float: right;
            clear:both;
            color:white;
            display: inline-block;
            border-radius: 3px;"></p>
        </div>
    </div>
</script>

<script>
    function init() {
        // send button click handling
        $('.send-message').click(sendMessage);
        $('.input-message').keypress(checkSend);
    }

    // Send on enter/return key
    function checkSend(e) {
        if (e.keyCode === 13) {
            return sendMessage();
        }
    }

    // Handle the send button being clicked
    function sendMessage() {
        var messageText = $('.input-message').val();
        if (messageText.length < 3) {
            return false;
        }

        // Build POST data and make AJAX request
        var data = {chat_text: messageText};
        $.post('message', data).success(sendMessageSuccess);

        // Ensure the normal browser event doesn't take place
        return false;
    }

    // Handle the success callback
    function sendMessageSuccess() {
        $('.input-message').val('');
        console.log('message sent successfully');
    }

    // Build the UI for a new message and add to the DOM
    function addMessage(data) {
        // Create element from template and set values
        //return  data.id
        var id_post = data.id;
        //truyen data.id snag ham nay de biet dc goi den view nao
        var el = createMessageEl(id_post);
        el.find('.message-body').html(data.text);
        el.find('.author').text(data.username);
        el.find('.avatar img').attr('src', 'upload/avt/' + data.avatar);

        // Utility to build nicely formatted time
        el.find('.timestamp').text(strftime('%H:%M:%S %P', new Date(data.timestamp)));
        var messages = $('#messages');
        messages.append(el);


        // Make sure the incoming message is shown
        messages.scrollTop(messages[0].scrollHeight);
    }
    //retun data.id

    // Creates an activity element from the template
    function createMessageEl(id_post) {
        var id_user = $('#pass').val();
        if (id_post == id_user) {
            var text = $('#chat_message_template_from').text();
        }
        else {
            var text = $('#chat_message_template_to').text();
        }
        var el = $(text);
        return el;
    }

    $(init);

    /***********************************************/

    var pusher = new Pusher('a787896b73a767e2aa91',
            {
                cluster: 'ap1',
                encrypted: true
            });

    var channel = pusher.subscribe('{{$chatChannel}}');
    channel.bind('new-message', addMessage);
</script>
</body>
</html>
