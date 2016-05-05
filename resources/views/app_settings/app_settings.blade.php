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
                    <!--  -->
                    <!--  -->
                    <hr>
                    <p>Change the color of the application</p>
                    <div class="box-body no-padding">
                          <table id="layout-skins-list" class="table table-striped bring-up nth-2-center">
                            <thead>
                              <tr>
                                <th style="width: 210px;">Skin Class</th>
                                <th>Preview</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><code>skin-blue</code></td>
                                <td><a href="#" data-skin="skin-blue" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a></td>
                              </tr>
                              <tr>
                                <td><code>skin-yellow</code></td>
                                <td><a href="#" data-skin="skin-yellow" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i></a></td>
                              </tr>
                              <tr>
                                <td><code>skin-purple</code></td>
                                <td><a href="#" data-skin="skin-purple" class="btn bg-purple btn-xs"><i class="fa fa-eye"></i></a></td>
                              </tr>
                              <tr>
                                <td><code>skin-red</code></td>
                                <td><a href="#" data-skin="skin-red" class="btn btn-danger btn-xs"><i class="fa fa-eye"></i></a></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                    <!--  -->
                    <form id="change_app_theme" action="/changeApplicationColor" method="post" id="visually-hidden">
                        <div class="input-group">
                            <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                            <input type="hidden" name="color_class_name" value="the color class" class="form-control">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary btn-flat"></button>
                                </span>
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
        $(document).on('click', 'tbody a', function(){
            var $new_skin = $(this).attr('data-skin');
            var $old_skin = $('body').attr('class');

            $('body').addClass($new_skin).removeClass($old_skin);

        });
    </script>

@endsection
