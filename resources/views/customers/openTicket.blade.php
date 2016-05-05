@extends('admin_template')


@section('content')

    <div class="row">

        <div class="col-md-6" id="toAddATicket">

            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Create ticket on behalf of customer</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="{{ action('CustomerController@openTicketUpdate', [$customer->id]) }}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Title</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail4" class="col-sm-2 control-label">Description</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="description" placeholder="Description">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Customer's email</label>

                            <div class="col-sm-10">
                            	<br>
                                {{$customer->email}}
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
        </div>
    </div>

@endsection
