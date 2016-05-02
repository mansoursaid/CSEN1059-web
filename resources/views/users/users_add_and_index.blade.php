@extends('admin_template')

@section('content')

       <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Support {{ $usersTypeStr }}
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add a new Support {{ $usersTypeStr }}</h3>
                        </div>

                        {!! Form::open(array('url' => '/users', 'method' => 'POST', 'class' => 'form-horizontal')) !!}
                            <div class="box-body">
                                <div class="form-group">
									{!! Form::label('name', 'Name: ', array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-10">
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
									{!! Form::label('email', 'Email: ', array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-10">
                                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
									{!! Form::label('password', 'Password: ', array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-10">
                                        {!! Form::password('password', array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                {{ Form::hidden('type', $usersTypeInt) }}
                            </div>
                            <div class="box-footer">
                                {!! Form::submit('Cancel', array('class' => 'btn btn-default')) !!}
                                {!! Form::submit('Add', array('class' => 'btn btn-info pull-right')) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- Shows the errors in the form -->
			<ul>
			  @foreach($errors->all() as $error)
			    <li>{{ $error }}</li>
			  @endforeach
			</ul>

            <div class="row">
                <h1 class="page-header" style="margin-left: 10px;">Supervisors</h1>
                <div class="col-md-4">

                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-yellow">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/user7-128x128.jpg" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Nadia Carmichael</h3>
                            <h5 class="widget-user-desc">Lead Developer</h5>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Projects <span class="pull-right badge bg-blue">PHP</span></a></li>
                                <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                                <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                                <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-gray-light">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/user7-128x128.jpg" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Nadia Carmichael</h3>
                            <h5 class="widget-user-desc">Lead Developer</h5>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Projects <span class="pull-right badge bg-blue">Rails</span></a></li>
                                <li><a href="#">Tickets <span class="pull-right badge bg-aqua">5</span></a></li>
                                <li><a href="#">Closed tickets <span class="pull-right badge bg-green">12</span></a></li>
                                <li><a href="#">Open tickets <span class="pull-right badge bg-red">3</span></a></li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-light-blue-active">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/user7-128x128.jpg" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Nadia Carmichael</h3>
                            <h5 class="widget-user-desc">Lead Developer</h5>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Projects <span class="pull-right badge bg-blue">IOS</span></a></li>
                                <li><a href="#">Tickets <span class="pull-right badge bg-aqua">5</span></a></li>
                                <li><a href="#">Closed tickets <span class="pull-right badge bg-green">12</span></a></li>
                                <li><a href="#">Open tickets <span class="pull-right badge bg-red">3</span></a></li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-aqua-gradient">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/user7-128x128.jpg" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Nadia Carmichael</h3>
                            <h5 class="widget-user-desc">Lead Developer</h5>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Projects <span class="pull-right badge bg-blue">Android</span></a></li>
                                <li><a href="#">Tickets <span class="pull-right badge bg-aqua">5</span></a></li>
                                <li><a href="#">Closed tickets <span class="pull-right badge bg-green">12</span></a></li>
                                <li><a href="#">Open tickets <span class="pull-right badge bg-red">3</span></a></li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="box box-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-green">
                            <div class="widget-user-image">
                                <img class="img-circle" src="dist/img/user7-128x128.jpg" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">Nadia Carmichael</h3>
                            <h5 class="widget-user-desc">Lead Developer</h5>
                        </div>
                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                                <li><a href="#">Projects <span class="pull-right badge bg-blue">HR</span></a></li>
                                <li><a href="#">Tickets <span class="pull-right badge bg-aqua">5</span></a></li>
                                <li><a href="#">Closed tickets <span class="pull-right badge bg-green">12</span></a></li>
                                <li><a href="#">Open tickets <span class="pull-right badge bg-red">3</span></a></li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /.content -->

@endsection
