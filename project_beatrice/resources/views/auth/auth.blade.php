<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>{{ trans('labels.authTitle') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Fogli di stile -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css">

    <!-- JQuery e plugin Js -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row" style="margin-top: 4em;">
            <div class="col-md-6 col-md-offset-3">
                <div>
                    @if (isset($alert))
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            {{ $alert }}
                        </div>
                    @endif
                    <ul class="nav nav-tabs">
                        <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span></a></li>
                        @if (isset($inRegistration))
                            <li><a href="#login-form" data-toggle="tab">{{ trans('labels.login') }}</a></li>
                            <li class="active"><a href="#register-form" data-toggle="tab">{{ trans('labels.register') }}</a></li>
                        @else
                            <li class="active"><a href="#login-form" data-toggle="tab">{{ trans('labels.login') }}</a></li>
                            <li><a href="#register-form" data-toggle="tab">{{ trans('labels.register') }}</a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        @if (isset($inRegistration))
                            <div class="tab-pane" id="login-form">
                                <form id="login-form" action="{{ route('user.login') }}" method="post"
                                    style="margin-top: 2em;">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="checkbox" name="remember">
                                        <label for="remember"> {{ trans('labels.rememberMe') }}</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit"
                                                    class="form-control btn btn-primary"
                                                    value="{{ trans('labels.login') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="text-center">
                                            <a href="#" class="forgot-password">{{ trans('labels.forgotPwd') }}</a>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane active" id="register-form">
                                <form id="register-form" action="{{ route('user.register') }}" method="post"
                                    style="margin-top: 2em;">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" placeholder="Username"
                                            value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control"
                                            placeholder="{{ trans('labels.emailAddr') }}" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" class="form-control"
                                            placeholder="{{ trans('labels.confirmPwd') }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit"
                                                    class="form-control btn btn-primary"
                                                    value="{{ trans('labels.registerNow') }}">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="tab-pane active" id="login-form">
                                <form id="login-form" action="{{ route('user.login') }}" method="post"
                                    style="margin-top: 2em;">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-group text-center">
                                        <input type="checkbox" name="remember">
                                        <label for="remember"> {{ trans('labels.rememberMe') }}</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="login-submit"
                                                    class="form-control btn btn-primary"
                                                    value="{{ trans('labels.login') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="text-center">
                                            <a href="#" class="forgot-password">{{ trans('labels.forgotPwd') }}</a>
                                        </div>

                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="register-form">
                                <form id="register-form" action="{{ route('user.register') }}" method="post"
                                    style="margin-top: 2em;">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" placeholder="Username"
                                            value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="email" class="form-control"
                                            placeholder="{{ trans('labels.emailAddr') }}" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="confirm-password" class="form-control"
                                            placeholder="{{ trans('labels.confirmPwd') }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <input type="submit" name="register-submit"
                                                    class="form-control btn btn-primary"
                                                    value="{{ trans('labels.registerNow') }}">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
