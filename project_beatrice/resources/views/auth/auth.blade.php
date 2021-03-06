<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>ADJ | {{ trans('labels.login') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Fogli di stile -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <!-- JQuery e plugin Js -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/js/form_check/loginCheck.js"></script>
</head>

<body>

    <div class="container">
        <div class="row" style="margin-top: 4em;">
            <div class="col-md-6 col-md-offset-3" id="whiteContainer">
                <div>
                    @if (isset($alert))
                        @include('components.alert', ['alert' => $alert])
                    @endif

                    <ul class="nav nav-tabs">
                        <li><a id="link-home" href="{{ route('home') }}">@include('icons.home')</a></li>
                        @if (isset($inRegistration))
                            <li><a href="#login-form" data-toggle="tab">{{ trans('labels.login') }}</a></li>
                            <li class="active"><a href="#register-form"
                                    data-toggle="tab">{{ trans('labels.register') }}</a></li>
                        @else
                            <li class="active"><a href="#login-form" data-toggle="tab">{{ trans('labels.login') }}</a>
                            </li>
                            <li><a href="#register-form" data-toggle="tab">{{ trans('labels.register') }}</a></li>
                        @endif
                        <li class="pull-right"><a href="{{ route('setLang', ['lang' => 'en']) }}" title="en"><img class="img img-rounded" width="30px"
                                    src="{{ url('/') }}/img/flags/en.png"></a></li>
                        <li class="pull-right"><a href="{{ route('setLang', ['lang' => 'it']) }}" title="it"><img
                                    class="img img-rounded" width="30px"
                                    src="{{ url('/') }}/img/flags/it.png"></a></li>
                    </ul>

                    <div class="tab-content">
                        @if (isset($inRegistration))
                            <div class="tab-pane" id="login-form">
                                @include('auth.login')
                            </div>

                            <div class="tab-pane active" id="register-form">
                                @include('auth.register')
                            </div>
                        @else
                            <div class="tab-pane active" id="login-form">
                                @include('auth.login')
                            </div>

                            <div class="tab-pane" id="register-form">
                                @include('auth.register')
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
