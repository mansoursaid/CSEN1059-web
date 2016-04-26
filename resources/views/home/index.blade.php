@extends('admin_template')



@section('content')

    <div class="row">
        <div class="col-md-6">
            <h2 class="page-header">Latest tweets</h2>
            <a class="btn" style="float: right; margin-right: 30px;">
                <i class="fa fa-refresh"></i>
            </a>
            <ul class="timeline" id="main_timeline">
                @foreach($newTweets as $newTweet)

                        <!-- timeline time label -->
                <li class="time-label">
                        <span class="bg-red">

                            {{ date('Y M d h:i:s', strtotime($newTweet->created_at))  }}

                        </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li id="{{ $newTweet->id }}" class="openTicket">
                    <i class="fa fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i></span>
                        <h3 class="timeline-header"><a href="#">{{ $newTweet->user->name }}</a><span class="storeHandle">{{ $newTweet->user->screen_name }}</span></h3>

                        <div class="timeline-body">
                            {{ $newTweet->text }}
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->

                @endforeach

                        <!-- END timeline item -->

            </ul>

            <ul class="timeline">
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>


            {{--<div id="foo" class="col-md-6">--}}
            <span class="pull-right badg" id="foo"></span>

            {{--</div>--}}

            {{--<ul class="pagination pagination-sm no-margin pull-right">--}}
            <button id="load_more"><a href="#">Load more</a></button>

            {{--</ul>--}}


        </div>

        <div class="col-md-6" id="toAddATicket">


            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Create ticket</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Title</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail4" class="col-sm-2 control-label">Description</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail4" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Customer's email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputPassword3" placeholder="email">
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right">Create</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest tickets</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <p>No recent tickets!</p>
                    </div><!-- /.box-body -->

                </form>
            </div>


        </div>


    </div>



@endsection


@section('custom_scripts')
    <script src="{{asset('/spin.js')}}"></script>
    <script src="http://peterolson.github.com/BigInteger.js/BigInteger.min.js"></script>

    {{--<script src="{{ asset('/home_script.js') }}"></script>--}}
    <script>

        var opts = {
            lines: 9 // The number of lines to draw
            , length: 9 // The length of each line
            , width: 5 // The line thickness
            , radius: 7 // The radius of the inner circle
            , scale: 0.5 // Scales overall size of the spinner
            , corners: 1 // Corner roundness (0..1)
            , color: '#000' // #rgb or #rrggbb or array of colors
            , opacity: 0.25 // Opacity of the lines
            , rotate: 0 // The rotation offset
            , direction: 1 // 1: clockwise, -1: counterclockwise
            , speed: 1 // Rounds per second
            , trail: 60 // Afterglow percentage
            , fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
            , zIndex: 2e9 // The z-index (defaults to 2000000000)
            , className: 'spinner' // The CSS class to assign to the spinner
            , top: '50%' // Top position relative to parent
            , left: '50%' // Left position relative to parent
            , shadow: false // Whether to render a shadow
            , hwaccel: false // Whether to use hardware acceleration
            , position: 'absolute' // Element positioning
        }


        $(document).ready(function () {

            $('#load_more').click(function (e) {


                var target = document.getElementById('foo')
                var spinner = new Spinner(opts).spin(target);
                $('#load_more').css("visibility", "hidden");

                var maxID = bigInt($('#main_timeline li:last').attr('id'));

                $("ul#main_timeline li.openTicket").each(function (index) {
                    var tempID = bigInt($(this).attr('id'));

                    if (tempID.lesserOrEquals(maxID)) {
                        maxID = tempID;

                    }
                });



                var form = $(this);
                var method = 'GET';
                var url = '/get_tweets/' + maxID.toString();

                $.ajax({
                    type: method,
                    url: url,
                    data: form.serialize(),
                    success: function (data) {
                        spinner.stop();
                        $('#load_more').css("visibility", "visible");
                        // use a temp wrapper element to workaround weak jQuery HTML parser
                        //
                        $newDivText = "";
                        for (i = 0; i < data.length; i++) {

                            var text = data[i].text;
                            var user = data[i].user.name;
                            var screen_name = data[i].user.screen_name;
                            var created_at = data[i].created_at;
                            var id = data[i].id;
                            $newDivText += "<li class='time-label'><span class='bg-red'>" +

                                    "{{ date('Y M d h:i:s', strtotime(" + created_at + "))}}" +

                                    "</span>" +
                                    "</li>" +

                                    "<li id='" + id + "' class='openTicket' onclick='x($(this))'>" +
                                    " <i class='fa fa-envelope bg-blue'></i> " +
                                    " <div class='timeline-item'>" +
                                    " <span class='time'><i class='fa fa-clock-o'></i></span>" +
                                    "<h3 class='timeline-header'><a href='#'>" + user + "</a> <span class='storeHandle'>" + screen_name + "</span></h3>" +

                                    "<div class='timeline-body'>" + text + "</div></div></li>";
                        }


                        $('#main_timeline').append($newDivText);
                    },

                    error: function (req, status, error) {
                        spinner.stop();
                        $('#load_more').css("visibility", "visible");
                        $('#foo').text('No more tweets');
                    }

                });

//                e.preventDefault();

            });


            $('li.openTicket').click(function () {
                var tweetId = $(this).attr('id');


                var user = $(this).find('h3.timeline-header a').text();


                var body = $(this).find('div.timeline-body').text();


                $newTicket = "<div class='box divOpenedTicket'>" +
                        "<div class='box-header'>" +
                        "<h3 class='box-title'>Mark as tickets</h3>" +
                        "</div>" +
                        "<div class='box-body'>" +

                        "<div class='margin'><a href='#'>" + user + "</a></div>" +

                        "<div class='margin'>" +
                        "<p>" + body + "</p>" +
                        "<div class='form-group'>" +
                        "<label>Assign to</label>" +
                        "<select class='form-control'>" +
                        "<optgroup label='Admins'></optgroup>" +
                        "@foreach($admins as $admin)" +
                        "<option value='{{ $admin->id }}'>{{ $admin->name }}</option>" +
                        "@endforeach" +

                        "<optgroup label='Support supervisors'></optgroup>" +
                        "@foreach($supportSupervisors as $supportSupervisor)" +
                        "<option value='{{ $supportSupervisor->id }}'>{{ $supportSupervisor->name }}</option>" +
                        "@endforeach" +
                        "<optgroup label='Support agents'></optgroup>" +
                        "@foreach($supportAgents as $supportAgent)" +
                        "<option value='{{ $supportAgent->id }}'>{{ $supportAgent->name }}</option>" +
                        "@endforeach" +
                        "</select>" +
                        "</div>" +
                        "<div class='form-group' style='float: right;'>" +
                        "<button class='btn btn-default' class='cancelTicket' onClick='hideNewTicket($(this))'>Cancel</button>" +
                        "<button class='btn btn-primary' class='saveTicket'>Save</button>" +
                        "</div>" +
                        "</div>" +
                        "</div><!-- /.box-body -->" +
                        "</div>";


                $('div#toAddATicket').prepend($newTicket);
            });


        });


        var x = function openTicket(myObj) {
            var tweetId = myObj.attr('id');


            var user = myObj.find('h3.timeline-header a').text();


            var body = myObj.find('div.timeline-body').text();

            $newTicket = "<div class='box divOpenedTicket'>" +
                    "<div class='box-header'>" +
                    "<h3 class='box-title'>Mark as tickets</h3>" +
                    "</div>" +
                    "<div class='box-body'>" +

                    "<div class='margin'><a href='#'>" + user + "</a></div>" +

                    "<div class='margin'>" +
                    "<p>" + body + "</p>" +
                    "<div class='form-group'>" +
                    "<label>Assign to</label>" +
                    "<select class='form-control'>" +
                    "<optgroup label='Admins'></optgroup>" +
                    "@foreach($admins as $admin)" +
                    "<option value='{{ $admin->id }}'>{{ $admin->name }}</option>" +
                    "@endforeach" +

                    "<optgroup label='Support supervisors'></optgroup>" +
                    "@foreach($supportSupervisors as $supportSupervisor)" +
                    "<option value='{{ $supportSupervisor->id }}'>{{ $supportSupervisor->name }}</option>" +
                    "@endforeach" +
                    "<optgroup label='Support agents'></optgroup>" +
                    "@foreach($supportAgents as $supportAgent)" +
                    "<option value='{{ $supportAgent->id }}'>{{ $supportAgent->name }}</option>" +
                    "@endforeach" +
                    "</select>" +
                    "</div>" +
                    "<div class='form-group' style='float: right;'>" +
                    "<button class='btn btn-default' class='cancelTicket' onClick='hideNewTicket($(this))'>Cancel</button>" +
                    "<button class='btn btn-primary' class='saveTicket'>Save</button>" +
                    "</div>" +
                    "</div>" +
                    "</div><!-- /.box-body -->" +
                    "</div>";


            $('div#toAddATicket').prepend($newTicket);
        }

        var hideNewTicket = function (myObj) {

           myObj.closest('div.divOpenedTicket').hide();

        }


    </script>
@endsection

