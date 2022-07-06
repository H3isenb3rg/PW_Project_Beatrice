@extends('layouts.master')

@section('title')
    ADJ | {{ trans('labels.myReservations') }}
@endsection

@section('scripts')
    <script src="{{ url('/') }}/js/event_well.js"></script>
@endsection

@section('left_navbar')
    <li class=><a href="{{ route('home') }}">@include('icons.home')</a></li>
    <li class="dropdown active">
        <a href="#" class="dropdown-toggle active" data-toggle="dropdown">{{ trans('labels.events') }} <b
                class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('event.index') }}"> @include('icons.calendar')</span>
                    {{ trans('labels.calendar') }}</a></li>
            <li class="divider"></li>
            <li class="active"><a>@include('icons.reservation')
                    {{ trans('labels.myReservations') }}</a>
            </li>
            @if ($isAdmin)
                <li class="divider"></li>
                <li><a href="{{ route('event.create') }}">@include('icons.newEvent')
                        {{ trans('labels.newEvent') }}</a></li>
            @endif
        </ul>
    </li>
@endsection

@section('right_navbar')
    <li><a><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
    <li><a href="{{ route('user.logout') }}">{{ trans('labels.logout') }} @include('icons.logout')</span></a></li>
@endsection

@section('breadcrumb')
    <li><a href="{{ route('home') }}">@include('icons.home')</a></li>
    <li class="active">@include('icons.reservation') {{ trans('labels.myReservations') }}</li>
@endsection

@section('corpo')
    <div id="whiteContainer" class="container" style="margin-bottom: 7.5em;">
        @if (isset($alert))
            @include('components.alert', ['alert' => $alert])
        @endif
        @if (isset($confirm))
            @include('components.confirm', ['confirm' => $confirm])
        @endif
        <div class="row">
            <div class="col-sm-12">
                <h2>{{ trans('labels.next_reservations') }}</h1>
                @include('components.reservation.list', ['reservationsList' => $reservationsList])
            </div>
        </div>
    </div>
@endsection
