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

@endsection

@section('custom_scripts')

<!--     <script>
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

        // on click on edit_user button the user will be redirected to the users.edit view
        $(document).on('click', '#edit_user', function(){
            $current_submit_button = 'input[value="' + $('#edit_user_form').attr('value') + '"]#edit_user_form';
            $($current_submit_button).click();
            console.log($current_submit_button);
        });

    </script> -->

@endsection
