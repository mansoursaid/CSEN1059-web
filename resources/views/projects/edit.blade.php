@extends('admin_template')

@section('content')
<section class="content">

<section class="content-header">
    <h1>
        Edit Project: <span style="font-style: italic">{{$project->name}}</span>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="margin">
                    <div class="box-body">
                    <br>
                        <div class="margin">
                                <form  action="/projects/{{$project->id}}" method="post" >
                                    {!! method_field('patch') !!}
                                    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                                    <div class="form-group">
                                        <label class="col-sm-2">Project Name</label>
                                        <div class="col-sm-10 ">
                                            <input type="text" name ="name" class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label class="col-sm-2">Project Desc.</label>
                                        <div class="col-sm-10 ">
                                            <textarea type="text" name="description" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="box-footer">
                                        <input class="btn btn-primary pull-right" type="submit" value="Submit">
                                    </div>
                                    <br>
                                    <br>
                                </form>
                            </div>
                        </div>
                </div><!--/.margin-->
            </div>
        </div>
        <div class="col-md-6">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection
