
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    <span class="label label-warning myNotificationCounter">{{ 0 }}</span>
</a>
<ul class="dropdown-menu">
    <li class="header">You have <span class="myNotificationCounter">{{ 0 }}</span> notifications</li>
    <li>
        <!-- Inner Menu: contains the notifications -->
        <?php $notifications2 = \App\Notification::where('user_id', \Auth::user()->id)->orderBy('created_at', 'desc')->get(); ?>
        <ul class="menu">
            <li id="empty_li"></li>
            @foreach($notifications2 as $notification)
                <li><a href='#'> <i class='fa fa-users text-aqua'></i>{{ $notification->message }}  </a></li>
            @endforeach
        </ul>
    </li>
    <li class="footer"><a href="{{ action('NotificationsController@index') }}">View all</a></li>
</ul>




<script src="https://cdn.socket.io/socket.io-1.3.5.js"></script>
<script>
    //var socket = io('http://localhost:3000');
    var socket = io('http://localhost:3000');
    socket.on("notifications-channel:App\\Events\\NotificationsEvent", function(message){
        // increase the power everytime we load test route
        // $('#notification').text($('#notification').text() + "\n" + message.data.message);
        console.log("hello");
        $('#empty_li').after("<li><a href='#'> <i class='fa fa-users text-aqua'></i>" + message.data.message + "</a></li>");
        $('span.myNotificationCounter').text(parseInt($('span.myNotificationCounter').text()) + 1);
    });
</script>







