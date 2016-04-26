@extends('admin_template')

@section('content')


    <div class="row">
        <div class="col-md-6">
            <h2 class="page-header">Ticket's conversation</h2>

            <ul class="timeline">
                <!-- timeline time label -->
                <li class="time-label">
                            <span class="bg-red">
                                10 Feb. 2014
                            </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-envelope bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                        <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>
                        <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->

                <li class="time-label">
                            <span class="bg-green">
                                3 Jan. 2014
                            </span>
                </li>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-camera bg-purple"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                        <div class="timeline-body">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                            <img src="http://placehold.it/150x100" alt="..." class="margin">
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <!-- timeline item -->
                <li>
                    <i class="fa fa-video-camera bg-maroon"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>
                        <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                        <div class="timeline-body">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                        <div class="timeline-footer">
                            <a href="#" class="btn btn-xs bg-maroon">See comments</a>
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>

            <!--<ul class="pagination pagination-sm no-margin pull-right">-->
            <!--<li><a href="#">«</a></li>-->
            <!--&lt;!&ndash;<li><a href="#">1</a></li>&ndash;&gt;-->
            <!--&lt;!&ndash;<li><a href="#">2</a></li>&ndash;&gt;-->
            <!--&lt;!&ndash;<li><a href="#">3</a></li>&ndash;&gt;-->
            <!--<li><a href="#">»</a></li>-->
            <!--</ul>-->

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
                        <p>Assigned to :     <b>{{  }}</b></p><br>
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
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                        <div class="form-group" style="float: right;">
                            <button class="btn btn-default">Cancel</button>
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
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                        <div class="form-group" style="float: right;">
                            <button class="btn btn-default">Cancel</button>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>

                </div><!-- /.box-body -->
            </div>



        </div>

    </div>




@endsection