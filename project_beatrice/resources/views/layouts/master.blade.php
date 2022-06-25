<!DOCTYPE html>

<html lang="it">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Fogli di stile -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css">

    <!-- JQuery e plugin Js -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>

    @yield('scripts')
</head>

<body>
    <div id="page-top"></div>
    <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand js-scroll-trigger logo-navbar" href="#page-top">
                <img class="logo-navbar" src="{{ url('/') }}/img/static/LOGO-ADJ-BLACK.jpg" alt="ADJ logo"
                    title="ADJ">
            </a>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <!-- Parte dipendente dalla vista | Placeholder-->
                    @yield('left_navbar')
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @yield('right_navbar')
                    <li><a href="{{ route('setLang', ['lang' => 'en']) }}" title="en" style="padding-right: 0"><img class="img img-rounded"
                                width="30px" src="{{ url('/') }}/img/flags/en.png"></a></li>
                    <li><a href="{{ route('setLang', ['lang' => 'it']) }}" title="it"><img class="img img-rounded"
                                width="30px" src="{{ url('/') }}/img/flags/it.png"></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <ul class="breadcrumb pull-right">
            @yield('breadcrumb')
        </ul>
    </div>

    @yield('corpo')
</html>
