
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    <span class="label label-warning">{{ 10 }}</span>
</a>
<ul class="dropdown-menu">
    <li class="header">You have {{ 10 }} notifications</li>
    <li>
        <!-- Inner Menu: contains the notifications -->
        <ul class="menu">
            <li id="empty_li"></li>
            <li><!-- start notification -->
                <a href="#">
                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                </a>
            </li><!-- end notification -->
        </ul>
    </li>
    <li class="footer"><a href="#">View all</a></li>
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
        });
    </script>







