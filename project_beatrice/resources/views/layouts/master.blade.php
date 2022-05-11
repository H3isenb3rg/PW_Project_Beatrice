<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Fogli di stile -->
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/style.css">

    <!-- JQuery e plugin Js -->
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="{{ url('/') }}/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar-default">
        <div class="container">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand js-scroll-trigger logo-navbar" href="#page-top">
                <img class="logo-navbar" src="{{ url('/') }}/img/static/LOGO-ADJ-BLACK.jpg" alt="ADJ logo">
            </a>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <!-- Parte dipendente dalla vista | Placeholder-->
                    @yield('left_navbar')
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @yield('right_navbar')
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <ul class="breadcrumb pull-right">
            @yield('breadcrumb')
        </ul>
    </div>

    <div class="container">
        <header class="header-sezione">
            <h1>
                @yield('title')
            </h1>
        </header>
    </div>

    @yield('corpo')

</html>
