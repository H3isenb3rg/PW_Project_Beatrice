@extends('layouts.master')

@section('title', 'Arcangelo DJ')

@section('left_navbar')
    <li class='active'><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Events<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('event.index') }}"><span class="glyphicon glyphicon-calendar"></span> Calendar</a></li>
            <!-- TODO: Se loggato bottone per visualizzare le mie iscrizioni -->
        </ul>
    </li>
@endsection

@section('right_navbar')
    @if($logged) 
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
            <div class="col-sm-9">
                <div class="box-lavoro-evidenza">
                    <p>Un semplicissimo esempio di sito web realizzato durante il corso di Programmazione Web e Servizi
                        Digitali. Il sito riporta l'elenco dei libri che sto leggendo o che ho letto, e la lista degli
                        autori che hanno popolato le mie letture e la mia fantasia. Il sito web continuerà a crescere
                        durante questo semestre, completandosi di volta in volta grazie all'applicazione delle
                        tecnologie web che verranno presentate nel corso. Buon divertimento!</p>
                    <blockquote>
                        <p>Semina un atto, e raccogli un'abitudine; semina un'abitudine, e raccogli un carattere; semina
                            un carattere, e raccogli un destino. </p>
                        <small>[Il pensiero del Buddha]</small>
                    </blockquote>
                </div>
            </div><!-- /.col-sm-8 -->
            <div class="col-sm-3">
                <div class="box-lavoro-evidenza">
                    <img src="{{ url('/') }}/img/static/team.PNG" class="img-thumbnail img-responsive">
                </div>
            </div><!-- /.col-sm-4 -->
        </div><!-- /.row -->
    </div>
@endsection
