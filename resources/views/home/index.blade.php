
@extends('admin_template')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <h2 class="page-header">Latest tweets</h2>
            <a class="btn" style="float: right; margin-right: 30px;">
                <i class="fa fa-refresh"></i>
            </a>
            <ul class="timeline">
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
                        <h3 class="timeline-header"><a href="#">{{ $newTweet->user->name }}</a></h3>
                        <div class="timeline-body">
                            {{ $newTweet->text }}
                        </div>
                    </div>
                </li>
                <!-- END timeline item -->


                @endforeach

                        <!-- END timeline item -->
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>

            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">»</a></li>
            </ul>


        </div>

        <div class="col-md-6">

            <div class="box" hidden>
                <div class="box-header">
                    <h3 class="box-title">Mark as tickets</h3>
                </div>
                <div class="box-body">

                    <div class="margin">
                        <p>Tweet basic info</p>
                        <div class="form-group">
                            <label>Assign to</label>
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

