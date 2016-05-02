@extends('admin_template')

@section('flash_messages')
    @if (session('status'))
        @if (session('status') == 'success')
            <div class="alert alert-success alert-dismissible">
                <i class="icon fa fa-check"></i>
                {{ session('object') }} added successfully!
            </div>
        @else
            <div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>
                {{ session('object') }} was not added!
            </div>
        @endif
    @endif
@endsection

@section('content')
       <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <!-- Support {{ $usersTypeStr }}s -->
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add a new {{ $usersTypeStr }}</h3>
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
                                {{ Form::hidden('password', str_random(8) )}}
                                {{ Form::hidden('type', $usersTypeInt) }}
                            </div>
                            <div class="box-footer">
                                {!! Form::submit('Cancel', array('class' => 'btn btn-default')) !!}
                                {!! Form::submit('Add', array('class' => 'btn btn-info pull-right')) !!}
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-md-6">
                    @if (count($errors))
                        <div class="box box-solid box-danger">
                            <div class="box-header">
                              <h3 class="box-title">Error!</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><!-- /.box-body -->
                          </div>
                    @endif
                </div>
            </div>
            <!-- Shows the errors in the form -->
            <!--  -->
            <div class="row">
                <h1 class="page-header" style="margin-left: 10px;">All {{ $usersTypeStr }}s</h1>
                   @foreach ($users as $user)
                       <div class="col-md-4">
                            <div class="box box-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-yellow">
                                    <div class="widget-user-image">
                                        {{ Html::image('user-avatar.jpg', 'alt', array( 'class' => 'img-circle' )) }}
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <h3 class="widget-user-username">{{$user->name}}</h3>
                                    <h5 class="widget-user-desc">{{$usersTypeStr}}</h5>
                                </div>
                                <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li><a href="#">Projects
                                            @if($user->projects()->count() == 0)
                                                <span class="pull-right badge bg-blue">
                                                    -
                                                </span>
                                            @else
                                                @foreach ($user->projects() as $project)
                                                    <span class="pull-right badge bg-blue">
                                                        {{$project->name}}
                                                    </span>
                                                @endforeach
                                            @endif
                                            </a>
                                        </li>
                                        <li><a href="#">Tickets
                                                <span class="pull-right badge bg-aqua">
                                                    {{$user->tickets()->count()}}
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>

        </section><!-- /.content -->

@endsection
