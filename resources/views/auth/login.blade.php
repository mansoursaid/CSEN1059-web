<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html>
    @include('_head')
    <body class="skin-blue">
        <div class="wrapper">
            <header class="main-header" id="guest-header"> </header>
<!-- Content -->
                <div class="content-wrapper" style="margin-left:0; height: 94vh;">
                    <section class="content-header"></section>
                    <section class="content">
                        <div class="col-md-6 col-md-offset-3">
                        <!--  -->
                            @if (count($errors))
                                <div class="box box-solid box-warning">
                                    <div class="box-header">
                                      <h3 class="box-title">Warning!</h3>
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
                        <!--  -->
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Sign in</h3>
                                </div>
                                <form class="form-horizontal" method="POST" action="/auth/login">
                                    {{ csrf_field() }}
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="email" class="col-sm-2 control-label">Email</label>

                                            <div class="col-sm-10">
                                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                                            <div class="col-sm-10">
                                                <input type="password" name="password" id="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember"> Remember me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-info pull-right">Sign in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section><!-- /.content -->
                </div><!-- /.content-wrapper -->
            <footer class="main-footer" id="footer" style="margin-left:0;"></footer>
        </div><!-- ./wrapper -->
    </body>
</html>
