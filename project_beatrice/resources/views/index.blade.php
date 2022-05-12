@extends('layouts.master')

@section('title', 'Arcangelo DJ')

@section('left_navbar')
    <li class='active'><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Events <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('event.index') }}"><span class="glyphicon glyphicon-calendar"></span> Calendar</a></li>
            @if ($logged)
                <li class="divider"></li>
                <li><a href="{{ route('event.index') }}"><span class="glyphicon glyphicon-time"></span> My Reservations</a>
                </li>
                @if ($isAdmin)
                    <li class="divider"></li>
                    <li><a href="{{ route('event.create') }}"><span class="glyphicon glyphicon-plus-sign"></span> New
                            Event</a></li>
                @endif
            @endif
        </ul>
    </li>
@endsection

@section('right_navbar')
    @if ($logged)
        <li><a><i>Welcome {{ $loggedName }}</i></a></li>
        <li><a href="{{ route('user.logout') }}">logout <span class="glyphicon glyphicon-log-out"></span></a></li>
    @else
        <li><a href="{{ route('user.login') }}"><span class="glyphicon glyphicon-user"></span> Log in</a></li>
    @endif
@endsection

@section('breadcrumb')
    <li><a class="active"><span class="glyphicon glyphicon-home"></span></a></li>
@endsection

@section('corpo')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="jumbotron">
                    <h1>Arcangelo DJ</h1>
                    <div class="row">
                        <div class="col-sm-5">
                            <p>Musica, ballo, animazione e spettacolo!!!</p>
                            <p>Feste, serate danzanti e show...</p>
                            <p><a class="btn btn-primary btn-lg" href="#" role="button">La nostra Galleria</a></p>
                        </div>
                        <div class="col-sm-7">
                            <img src="{{ url('/') }}/img/static/team.PNG" class="img img-responsive" alt="Il team Arcangelo DJ" title="Team ADJ">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
