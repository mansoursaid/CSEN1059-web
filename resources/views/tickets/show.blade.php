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

            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label>Reply</label>
                        <textarea class="form-control" rows="3" placeholder="reply ..."></textarea>
                    </div>
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
                        <p>Assigned to :   <a href="/users/{{ $assignedToUser->id }}"> <b>{{ $assignedToUser->name }}</b></a> </p><br>
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




@endsection