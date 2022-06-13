@extends('layouts.master')

@section('title', 'Arcangelo DJ')

@section('left_navbar')
    <li class=><a href="{{ route('home') }}"><span class="bi bi-house-fill"></span></a></li>
    <li class="dropdown active">
        <a href="#" class="dropdown-toggle active" data-toggle="dropdown">{{ trans('labels.events') }} <b
                class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('event.index') }}"><span class="bi bi-calendar3"></span>
                    {{ trans('labels.calendar') }}</a></li>
            <li class="divider"></li>
            <li><a href="{{ route('event.index') }}"><span class="glyphicon glyphicon-time"></span>
                    {{ trans('labels.myReservations') }}</a>
            </li>
            <li class="divider"></li>
            <li class="active"><a href="{{ route('event.create') }}"><span
                        class="glyphicon glyphicon-plus-sign"></span> {{ trans('labels.newEvent') }}</a></li>
        </ul>
    </li>
@endsection

@section('right_navbar')
    <li><a><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
    <li><a href="{{ route('user.logout') }}">{{ trans('labels.logout') }} <span
                class="glyphicon glyphicon-log-out"></span></a></li>
@endsection

@section('breadcrumb')
    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="active"><span class="glyphicon glyphicon-plus-sign"></span> {{ trans('labels.newEvent') }}</li>
@endsection

@section('corpo')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (isset($confirm))
                    @include('components.confirm', ['confirm' => $confirm])
                @endif

                @if (isset($alert))
                    @include('components.alert', ['alert' => $alert])
                @endif

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @include('components.createVenue')
                    @include('components.createEvent')
                </div>
            </div>
        </div>
    </div>
@endsection
