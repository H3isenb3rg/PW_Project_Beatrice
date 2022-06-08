<!DOCTYPE html>

<html lang="it">

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
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" class="init">
        $(document).ready(function () {
            $("#example").DataTable();
        });
    </script>
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
                <img class="logo-navbar" src="{{ url('/') }}/img/static/LOGO-ADJ-BLACK.jpg" alt="ADJ logo" title="ADJ">
            </a>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <!-- Parte dipendente dalla vista | Placeholder-->
                    @yield('left_navbar')
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <a href="{{ route("setLang", ["lang" => "en"]) }}"><img class="img img-rounded" width="30px" src="{{ url('/') }}/img/flags/en.png"></a>
                    <a href="{{ route("setLang", ["lang" => "it"]) }}"><img class="img img-rounded" width="30px" src="{{ url('/') }}/img/flags/it.png"></a>
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

    @yield('corpo')

</html>
