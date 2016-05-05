@extends('admin_template')

@section('content')


    <div class="row">
        <div class="col-md-6">
            <h2 class="page-header">Ticket's conversation</h2>

            <ul class="timeline" id="main_timeline">
                @foreach($conversation as $newTweet)

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
                        <h3 class="timeline-header"><a href="#">{{ $newTweet->user->name }}</a></h3>
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

            <form class="form-horizontal" method="POST" action="{{ action('TweetsController@replyToTicket') }}">
                <div class="box-body">
                    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                    <div class="form-group">
                        <label>Reply</label>
                        <textarea name="status" class="form-control" rows="3" placeholder="reply ..."></textarea>
                    </div>
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}"/>
                    <input id="lastTweetId" type="hidden" name="last_tweet_id" value=""/>
                </div>
                <!-- /.box-body -->
                <!--<div class="box-footer">-->
                <button type="submit" class="btn btn-info pull-right">Send</button>
                <!--</div>-->
                <!-- /.box-footer -->
            </form>



        </div>

        <div class="col-md-6">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Ticket's Info</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        @if($assignedToUser != null)
                            <p>Assigned to :   <a href="/users/{{ $assignedToUser->id }}"> <b>{{ $assignedToUser->name }}</b></a> </p><br>
                        @else
                            <p>Not assigned</p>
                        @endif
                        <p>Status : <span class="pull-right badge bg-green">{{ $ticket->status }}</span></p><br>
                        <p>Urgency : <span class="pull-right badge bg-red">{{ $ticket->urgency }}</span></p>
                        @if($ticket->premium)
                            <p><span class="pull-right badge bg-red">Premium</span></p>
                        @endif
                    </div><!-- /.box-body -->

                </form>
            </div>


            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Reassigning</h3>
                </div>
                <div class="box-body">

                    <div class="margin">
                        <div class="form-group">
                            <label>Reassign to</label>
                            <select id='reassignForm' class="form-control">
                                <optgroup label="--Admins--">
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="--Support supervisors--">
                                    @foreach($supportSupervisors as $supportSupervisor)
                                        <option value="{{ $supportSupervisor->id }}">{{ $supportSupervisor->name }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="--Support agents--">
                                    @foreach($supportAgents as $supportAgent)
                                        <option value="{{ $supportAgent->id }}">{{ $supportAgent->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group" style="float: right;">
                            {{--<button class="btn btn-default">Cancel</button>--}}
                            <button id="reassignBtn" class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </div><!-- /.box-body -->
            </div>

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Invitation</h3>
                </div>
                <div class="box-body">

                    <div class="margin">
                        <div class="form-group">
                            <label>Invite</label>
                            <select class="form-control">
                                <optgroup label="--Admins--">
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="--Support supervisors--">
                                    @foreach($supportSupervisors as $supportSupervisor)
                                        <option value="{{ $supportSupervisor->id }}">{{ $supportSupervisor->name }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="--Support agents--">
                                    @foreach($supportAgents as $supportAgent)
                                        <option value="{{ $supportAgent->id }}">{{ $supportAgent->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group" style="float: right;">
                            {{--<button class="btn btn-default">Cancel</button>--}}
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </div><!-- /.box-body -->
            </div>



        </div>

    </div>
<form  class="myForm" action="/tickets/{{ $ticket->id }}/assign" method="post" style="display:none">
    {!! method_field('patch') !!}
    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
    <input class="val" type="text" name="assigned_to"><br><br>
    <input class="val2" type="text" name="old_assigned"><br><br>
    <input type="submit" value="Submit">
</form>



@endsection

@section('custom_scripts')

    <script>
        $(document).ready(function (){
            var lastTimeLineLiId = $("ul#main_timeline li:last-child").attr('id');
            $('#lastTweetId').val(lastTimeLineLiId);
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $("button#reassignBtn").click(function(){
               $(".val").val($('#reassignForm').val());
               $(".val2").val({{$ticket->assigned_to}});
               $(".myForm").submit();
            });
            
        });
</script>

@endsection