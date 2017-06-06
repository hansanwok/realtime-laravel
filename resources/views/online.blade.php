<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Online</title>
    <base href="{{asset('')}}">
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="javascript" src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/online.css">
    <script src="https://use.fontawesome.com/45e03a14ce.js"></script>
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
<div class="main_section">
    <div class="container">
        <div class="chat_container">
            <div class="col-sm-3 chat_sidebar">
                <div class="row">

                    <div class="dropdown all_conversation">
                        <button class="dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-weixin" aria-hidden="true"></i>
                            Who is Online
                            <span class="caret pull-right"></span>
                        </button>
                    </div>
                    <div class="member_list">
                        <ul class="list-unstyled" id="members">

                        </ul>
                    </div> <!--message_section-->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var pusher = new Pusher('a787896b73a767e2aa91',
            {
                cluster: 'ap1',
                authEndpoint: 'pusher/auth',
                auth: {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                encrypted: true
            });
    var presenceChannel = pusher.subscribe('{{$Channel}}');

    presenceChannel.bind('pusher:subscription_succeeded', function (members) {
        //lam trong danh sach
        $("#members").empty();
        members.each(function (member) {
            addMember(member);
        });
    });

    presenceChannel.bind("pusher:member_added", function (member) {
        addMember(member);
    });

    presenceChannel.bind("pusher:member_removed", function (member) {
        removeMember(member);
    });

    function addMember(member) {
        // tao 1 doan the li co chua info cua ng dung dc nhan ty pusher ve
        var p = '<li class="left clearfix" id="member_' + member.id + ' "> <span class="chat-img pull-left"> <img src="upload/avt/' + member.info.avatar + '" alt="User Avatar" class="img-circle"> </span> <div class="chat-body clearfix"> <div class="header_sec"> <strong class="primary-font">' + member.info.username + '</strong> <strong class="pull-right">Online</strong> </div> <div class="contact_sec"> <span class="badge pull-right" style="background-color: green">&nbsp;</span></div></div></li>';
        $("#members").append(p);
    }

    function removeMember(member) {
        //tren the li co id rieng minh gan vao, sau do minh xoa theo tung id do
        $("#member_" + member.id).remove();

    }

</script>
</body>
</html>