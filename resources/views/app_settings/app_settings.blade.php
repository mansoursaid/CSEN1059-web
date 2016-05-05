@extends('admin_template')

@section('custom_links')

    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.css') }}">

@endsection

@section('flash_messages')
    @if (session('status'))
        @if (session('status') == 'success')
            <div class="alert alert-success alert-dismissible">
                <i class="icon fa fa-check"></i>
                {{ session('object') }} was changed successfully!
            </div>
        @else
            <div class="alert alert-danger alert-dismissible">
                <i class="icon fa fa-ban"></i>
                {{ session('object') }} was not changed!
            </div>
        @endif
    @endif
@endsection

@section('content')


    <div class="row">
        <div class="col-md-6">


            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Logo &amp; Theme Color</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">
                    <!--Logo-->
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset('robusta_logo.png') }}" alt="Logo">
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" id="exampleInputFile">

                            <!--<p class="help-block">Example block-level help text here.</p>-->
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-block btn-primary">Change logo</button>
                        </div>
                    </form>
                    <!-- Color Picker -->
                    <form>
                        <div class="form-group">
                            <label>Color picker:</label>

                            <div class="input-group my-colorpicker2 colorpicker-element">
                                <input type="text" class="form-control">

                                <div class="input-group-addon">
                                    <i style="background-color: rgb(0, 0, 0);"></i>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-block btn-primary">Confirm</button>
                        </div>
                    </form>
                    <!-- /.form group -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>


    </div>
    <div class="row">

        <div class="col-md-6">
            <!-- Twitter consumer key -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Twitter consumer key</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">

                    <form action="change_twitter_consumer_key" method="post">
                        <div class="input-group">
                            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                            <input type="text" name="twitter_consumer_key" value="{{ $twitterConsumerKey }}" placeholder="Twitter consumer key" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat">Change</button>
                                    </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

            <!-- Twitter consumer key secret -->

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Twitter consumer key secret</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">

                    <form action="change_twitter_consumer_key_secret" method="post">
                        <div class="input-group">
                            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                            <input type="text" name="twitter_consumer_key_secret" value="{{ $twitterConsumerKeySecret }}" placeholder="Twitter consumer key secret" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat">Change</button>
                                    </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

            <!-- Twitter access token -->

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Twitter Access Token</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">

                    <form action="change_twitter_access_token" method="post">
                        <div class="input-group">
                            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                            <input type="text" name="twitter_access_token" value="{{ $twitterAccessToken }}" placeholder="Twitter access token" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat">Change</button>
                                    </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

            <!-- Twitter access token secret -->

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Twitter Access Token Secret</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">

                    <form action="change_twitter_access_token_secret" method="post">
                        <div class="input-group">
                            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                            <input type="text" name="twitter_access_token_secret" value="{{ $twitterAccessTokenSecret }}" placeholder="Twitter access token secret" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat">Change</button>
                                    </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>


        </div>



        <div class="col-md-6">

            <!-- Paypal client id -->

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Paypal Client ID</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">

                    <form action="change_paypal_client_id" method="post">
                        <div class="input-group">
                            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                            <input type="text" name="paypal_client_id" value="{{ $paypalClientID }}" placeholder="Paypal client ID" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat">Change</button>
                                    </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

            <!-- Paypal secret key -->

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Paypal Secret Key</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="display: block;">

                    <form action="change_paypal_secret_key" method="post">
                        <div class="input-group">
                            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                            <input type="text" name="paypal_secret_key" value="{{ $paypalSecretKey }}" placeholder="Paypal secret key" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat">Change</button>
                                    </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

        </div>



    </div>



@endsection


@section('custom_scripts')

    <script src="{{ asset('/bower_components/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
    <script>
        $(function () {
            //color picker with addon
            $(".my-colorpicker2").colorpicker();

        });
    </script>

@endsection
