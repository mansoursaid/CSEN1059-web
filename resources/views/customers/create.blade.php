@extends('admin_template')

@section('flash_messages')
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <i class="icon fa fa-check"></i>
            {!! Session::get('success') !!}
        </div>
    @endif

    @if(($errors->has()))
        <div class="alert alert-danger alert-dismissible">
            <i class="icon fa fa-ban"></i>
            <br>
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </div>
    @endif
@endsection

@section('content')
    <section class="content">

        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="margin">
                            <br>
                            <br>
                            <div class="form-group">
                                <form class="form-horizontal"
                                      action="{{ action('CustomerController@store') }}"
                                      method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>

                                    <div class="form-group">
                                        <label for="Name" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name" id="name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="email" id="email">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone_number" class="col-sm-2 control-label">Phone number</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="phone_number"
                                                   id="phone_number">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="twitter_handle" class="col-sm-2 control-label">Twitter
                                            handle</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="twitter_handle"
                                                   id="twitter_handle">
                                        </div>
                                    </div>

                                    <br>
                                    <br>
                                    <input class="btn btn-primary pull-right" type="submit" value="Submit">
                                    <br>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
