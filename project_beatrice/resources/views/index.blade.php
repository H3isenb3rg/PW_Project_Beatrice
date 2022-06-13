@extends('layouts.master')

@section('title', 'Arcangelo DJ')

@section('left_navbar')
    <li class='active'><a href="{{ route('home') }}">@include("icons.home")</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('labels.events') }} <b
                class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('event.index') }}">@include("icons.calendar") {{ trans('labels.calendar') }}</a></li>
            @if ($logged)
                <li class="divider"></li>
                <li><a href="{{ route('event.index') }}">@include("icons.reservation")
                        {{ trans('labels.myReservations') }}</a>
                </li>
                @if ($isAdmin)
                    <li class="divider"></li>
                    <li><a href="{{ route('event.create') }}">@include("icons.newEvent") {{ trans('labels.newEvent') }}</a></li>
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
        <li><a href="{{ route('user.login') }}"><span class="bi bi-person-circle"></span>
                {{ trans('labels.login') }}</a></li>
    @endif
@endsection

@section('breadcrumb')
    <li><a class="active"><span class="bi bi-house-fill"></span></a></li>
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
