@extends('admin_template')

@section('content')
<section class="content">

<section class="content-header">
    <h1>
        Edit {{App\User::intTypeToStr($user->type)}} <span style="font-style: italic">{{$user->name}}</span>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="margin">
                    <br>
                    <label class="col-sm-2 control-label">
                        Name:&nbsp;&nbsp;&nbsp;&nbsp;{{$user->name}}
                    </label>
                    <br>
                    <br>
                    <label class="col-sm-2 control-label">
                        Email:&nbsp;&nbsp;&nbsp;&nbsp;{{$user->email}}
                    </label>
                    <br>
                    <div class="margin">
                        <div class="form-group">
                            <form  action="/users/{{$user->id}}" method="post" >
                                {!! method_field('patch') !!}
                                <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                                <label>Change type to:&nbsp;</label>
                                <select name="types" class="form-control" style="width:60%; display: inline-block;">
                                    <option value="00">Admin</option>
                                    <option value="01">Supervisor</option>
                                    <option value="10">Agent</option>
                                </select>
                                <br>
                                <br>
                                <input class="btn btn-primary pull-right" type="submit" value="Submit">
                                <br>
                                <br>
                        </div>
                    </div>
                </div><!--/.margin-->
            </div>
        </div>
    </div>
</section>
@endsection
