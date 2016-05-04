@extends('admin_template')

@section('flash_messages')
    @if (session('status'))
        @if (session('status') == 'user_added_success')
            <div class="alert alert-success alert-dismissible">
                <i class="icon fa fa-check"></i>
                {{ session('object') }} added successfully!
            </div>
        @elseif (session('status') == 'user_added_failure')
            <div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>
                {{ session('object') }} was not added!
            </div>
        @elseif (session('status') == 'user_delete_success')
            <div class="alert alert-success alert-dismissible">
                <i class="icon fa fa-check"></i>
                User deleted!
            </div>
        @elseif (session('status') == 'user_delete_failure')
            <div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>
                Failed to delete user!
            </div>
        @elseif (session('status') == 'do_not_delete_self')
            <div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>
                You can not delete yourself!
            </div>
        @elseif (session('status') == 'user_update_success')
            <div class="alert alert-success alert-dismissible">
                <i class="icon fa fa-check"></i>
                User updated successfully!
            </div>
        @elseif (session('status') == 'user_update_failure')
            <div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>
                User was not updated success!
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

                @if ($users->count() > 0)
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
                                        <li><a >Tickets
                                                <span class="pull-right badge bg-aqua">
                                                    {{$user->tickets()->count()}}
                                                </span>
                                            </a>
                                        </li>
                                        <ul style="padding-right: 35px;">
                                               <li>
                                                   <a >Open Tickets
                                                       <span class="pull-right badge bg-aqua">
                                                           {{ App\User::getTicketsPerAgent($user->id)[0]["status1"] }}
                                                       </span>
                                                   </a>
                                               </li>
                                               <li>
                                                   <a >In Progress Tickets
                                                       <span class="pull-right badge bg-aqua">
                                                           {{ App\User::getTicketsPerAgent($user->id)[0]["status2"] }}
                                                       </span>
                                                   </a>
                                               </li>
                                               <li>
                                                   <a >Closed Tickets
                                                       <span class="pull-right badge bg-aqua">
                                                           {{ App\User::getTicketsPerAgent($user->id)[0]["status3"] }}
                                                       </span>
                                                   </a>
                                               </li>
                                        </ul>
                                        <!--  -->
                                        <li>
                                            <input class="btn btn-info pull-right" id="edit_user" value="Edit" style="width:44%">
                                            <input class="btn btn-info" id="delete_user" value="Delete" style="width:44%">
                                        </li>
                                        <!--  -->
                                        <li id="visually-hidden">
                                            {{ Form::open(array('route' => array('users.destroy', $user->id), 'method' => 'delete')) }}
                                            {!! Form::submit($user->id, array('id' => 'delete_user_form')) !!}
                                            {{ Form::close() }}
                                            <!--  -->
                                            {{ Form::open(array('route' => array('users.edit', $user->id), 'method' => 'get')) }}
                                            {!! Form::submit($user->id, array('id' => 'edit_user_form')) !!}
                                            {{ Form::close() }}

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div>
                        <h4 style="margin-left: 15px;">0 employees under this category!</h4>
                    </div>

                @endif
            </div>
        </section><!-- /.content -->
<!--  -->
        <div class="modal" id="delete_user_confirmation_modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Warning!!</h4>
              </div>
              <div class="modal-body">
                <p style="text-align:center">Are you sure you want to delete this user</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No, Cancel</button>
                <button type="button" id="confirm_delete_user" class="btn btn-primary">Yes, Delete</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<!--  -->
@endsection

@section('custom_scripts')

    <script>
        //stores the submit button id for the delete_user_form form
        var $current_submit_button;

        // on click on delete_user button a confirmation modal will appear & we will store the button id
        $(document).on('click', '#delete_user', function(){
            $('#delete_user_confirmation_modal').modal('show');
            $current_submit_button = 'input[value="' + $('#delete_user_form').attr('value') + '"]#delete_user_form';
            console.log($current_submit_button);
        });

        // if user confirms delete the user is deleted
        $(document).on('click', '#confirm_delete_user', function(){
            $('#delete_user_confirmation_modal').modal('hide');
            $($current_submit_button).click();
        });
// ---------------------------
// ---------------------------
        // on click on edit_user button the user will be redirected to the users.edit view
        $(document).on('click', '#edit_user', function(){
            $current_submit_button = 'input[value="' + $('#edit_user_form').attr('value') + '"]#edit_user_form';
            $($current_submit_button).click();
            console.log($current_submit_button);
        });

    </script>

@endsection
