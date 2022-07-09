@extends('layouts.master')

@section('title')
    ADJ | {{ trans('labels.calendar') }}
@endsection


@section('scripts')
    <script src="{{ url('/') }}/js/event_well.js"></script>
    <script src="{{ url('/') }}/js/showFillDelete.js"></script>
    <script>
        /** @type {string} The date of the last loaded event*/
        var last_loaded_date = "{{ $last_loaded_date }}";
        var icon_arrow_up = "@include('icons.arrow-up-circle')";
        var icon_calendar_x = "@include('icons.calendarX')";
    </script>
    <script src="{{ url('/') }}/js/load_events.js"></script>
@endsection

@section('left_navbar')
    <li class=><a href="{{ route('home') }}">@include('icons.home')</a></li>
    <li class="dropdown active">
        <a href="#" class="dropdown-toggle active" data-toggle="dropdown">{{ trans('labels.events') }} <b
                class="caret"></b></a>
        <ul class="dropdown-menu">
            <li class="active"><a href="{{ route('event.index') }}"> @include('icons.calendar')</span>
                    {{ trans('labels.calendar') }}</a></li>
            @if ($logged)
                <li class="divider"></li>
                <li><a href="{{ route('reservation.index') }}">@include('icons.reservation')
                        {{ trans('labels.myReservations') }}</a>
                </li>
                @if ($isAdmin)
                    <li class="divider"></li>
                    <li><a href="{{ route('event.create') }}">@include('icons.newEvent')
                            {{ trans('labels.newEvent') }}</a></li>
                @endif
            @endif
        </ul>
    </li>
@endsection

@section('right_navbar')
    @if ($logged)
        <li><a><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
        <li><a href="{{ route('user.logout') }}">{{ trans('labels.logout') }} @include('icons.logout')</span></a>
        </li>
    @else
        <li><a href="{{ route('user.login') }}">@include('icons.user')
                {{ trans('labels.login') }}</a></li>
    @endif
@endsection

@section('breadcrumb')
    <li><a href="{{ route('home') }}">@include('icons.home')</a></li>
    <li class="active">@include('icons.calendar') {{ trans('labels.calendar') }}</li>
@endsection

@section('corpo')
    @if (isset($alert))
        @include('components.alert', ['alert' => $alert])
    @endif

    @if (isset($confirm))
        @include('components.confirm', ['confirm' => $confirm])
    @endif
    <div id="whiteContainer" class="container" style="margin-bottom: 7.5em;">
        @include('components.event.list', ['eventsList' => $eventsList])
    </div>
@endsection
