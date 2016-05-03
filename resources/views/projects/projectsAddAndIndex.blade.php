@extends('admin_template')

@section('flash_messages')
    @if (session('status'))
        @if (session('status') == 'project_creation_success')
            <div class="alert alert-success alert-dismissible">
                <i class="icon fa fa-check"></i>
                    Project created successfully!
            </div>
        @elseif (session('status') == 'project_creation_failure')
            <div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>
                    Project was not created!
            </div>
        @elseif (session('status') == 'project_update_success')
            <div class="alert alert-success alert-dismissible">
                <i class="icon fa fa-check"></i>
                    Project updateed successfully!
            </div>
        @elseif (session('status') == 'project_update_failure')
            <div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>
                    Project was not updated!
            </div>
        @elseif (session('status') == 'project_delete_success')
            <div class="alert alert-success alert-dismissible">
                <i class="icon fa fa-check"></i>
                    Project deleted successfully!
            </div>
        @elseif (session('status') == 'project_delete_failure')
            <div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>
                    Project was not deleted!
            </div>
        @endif
    @endif
@endsection

@section('content')
       <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            <!--  -->
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add a new Project</h3>
                        </div>

                        {!! Form::open(array('url' => '/projects', 'method' => 'POST', 'class' => 'form-horizontal')) !!}
                            <div class="box-body">
                                <div class="form-group">
									{!! Form::label('name', 'Project Name: ', array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-10">
                                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
									{!! Form::label('description', 'Project Description: ', array('class' => 'col-sm-2 control-label')) !!}
                                    <div class="col-sm-10">
                                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                {{ Form::hidden('created_by', $user->id) }}
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
                <h1 class="page-header" style="margin-left: 10px;">All Projects</h1>

                @if ($projects->count() > 0)
                   @foreach ($projects as $project)
                       <div class="col-md-4">
                            <div class="box box-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-yellow">
                                    <h3 class="widget-user-username" style="text-align:left;margin-left:0;">Project Name: <span style="font-weight:700">{{ $project->name }}</span></h3>
                                </div>
                                <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked">
                                        <li><a href="#">Project description</a>
                                            <div style="margin-left: 22px;">{{ $project->description }}</div>
                                        </li>
                                        <li><a href="#">Created by</a>
                                            <div style="margin-left: 22px;">{{ App\User::getName($project->created_by) }}</div>
                                        </li>
                                        <!--  -->
                                        <li style="margin-top: 20px;">
                                            <input class="btn btn-info pull-right" id="edit_project" value="Edit" style="width:44%">
                                            <input class="btn btn-info" id="delete_project" value="Delete" style="width:44%">
                                        </li>
                                        <!--  -->
                                        <li id="visually-hidden">
                                            {{ Form::open(array('route' => array('projects.destroy', $project->id), 'method' => 'delete')) }}
                                            {!! Form::submit($project->id, array('id' => 'delete_project_form')) !!}
                                            {{ Form::close() }}
                                            <!--  -->
                                            {{ Form::open(array('route' => array('projects.edit', $project->id), 'method' => 'get')) }}
                                            {!! Form::submit($project->id, array('id' => 'edit_project_form')) !!}
                                            {{ Form::close() }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div>
                        <h4 style="margin-left: 15px;">0 projects so far!</h4>
                    </div>
                @endif
            </div>
        </section><!-- /.content -->
<!--  -->
        <div class="modal" id="delete_project_confirmation_modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Warning!!</h4>
              </div>
              <div class="modal-body">
                <p style="text-align:center">Are you sure you want to delete this project</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">No, Cancel</button>
                <button type="button" id="confirm_delete_project" class="btn btn-primary">Yes, Delete</button>
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

        // on click on delete_project button a confirmation modal will appear & we will store the project delete button id
        $(document).on('click', '#delete_project', function(){
            $('#delete_project_confirmation_modal').modal('show');
            $current_submit_button = 'input[value="' + $('#delete_project_form').attr('value') + '"]#delete_project_form';
            console.log($current_submit_button);
        });

        // if user confirms delete the delete_project_form is submitted and the project is deleted
        $(document).on('click', '#confirm_delete_project', function(){
            $('#delete_project_confirmation_modal').modal('hide');
            $($current_submit_button).click();
        });

        // on click on edit_user button the user will be redirected to the users.edit view
        $(document).on('click', '#edit_project', function(){
            $current_submit_button = 'input[value="' + $('#edit_project_form').attr('value') + '"]#edit_project_form';
            $($current_submit_button).click();
            console.log($current_submit_button);
        });

    </script>

@endsection
