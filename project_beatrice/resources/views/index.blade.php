@extends('layouts.master')

@section('title', 'Arcangelo DJ')

@section('left_navbar')
    <li class='active'><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('labels.events') }} <b
                class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('event.index') }}"><span class="glyphicon glyphicon-calendar"></span>
                    {{ trans('labels.calendar') }}</a></li>
            @if ($logged)
                <li class="divider"></li>
                <li><a href="{{ route('event.index') }}"><span class="glyphicon glyphicon-time"></span>
                        {{ trans('labels.myReservations') }}</a>
                </li>
                @if ($isAdmin)
                    <li class="divider"></li>
                    <li><a href="{{ route('event.create') }}"><span class="glyphicon glyphicon-plus-sign"></span>
                            {{ trans('labels.newEvent') }}</a></li>
                @endif
            @endif
        </ul>
    </li>
@endsection

@section('right_navbar')
    @if ($logged)
        <li><a><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
        <li><a href="{{ route('user.logout') }}">{{ trans('labels.logout') }} <span
                    class="glyphicon glyphicon-log-out"></span></a></li>
    @else
        <li><a href="{{ route('user.login') }}"><span class="glyphicon glyphicon-user"></span>
                {{ trans('labels.login') }}</a></li>
    @endif
@endsection

@section('breadcrumb')
    <li><a class="active"><span class="glyphicon glyphicon-home"></span></a></li>
@endsection

@section('corpo')
    <div class="container">
        @if (isset($alert))
            @include('components.alert', ['alert' => $alert])
        @endif

        @if (isset($confirm))
            @include('components.confirm', ['confirm' => $confirm])
        @endif

        @include('components.home.gallery')

        @include('components.home.events', ['eventsList' => $eventsList])
    </div>
@endsection
