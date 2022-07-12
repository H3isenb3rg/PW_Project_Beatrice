@extends('layouts.master')

@section('title', 'Arcangelo DJ')

@section('scripts')
    <script src="{{ url('/') }}/js/event_well.js"></script>
    <script src="{{ url('/') }}/js/showFillDelete.js"></script>
@endsection

@section('left_navbar')
    <li class='active'><a href="{{ route('home') }}">@include('icons.home')</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('labels.events') }} <b
                class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('event.index') }}">@include('icons.calendar') {{ trans('labels.calendar') }}</a>
            </li>
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
        <li><a href="{{ route('user.logout') }}">{{ trans('labels.logout') }} @include('icons.logout')</a></li>
    @else
        <li><a href="{{ route('user.login') }}">@include('icons.user')
                {{ trans('labels.login') }}</a></li>
    @endif
@endsection

@section('breadcrumb')
    <li class="active">@include("icons.home")</li>
@endsection

@section('corpo')
    <div class="container">
        @if (isset($alert))
            @include('components.alert', ['alert' => $alert])
        @endif

        @if (isset($confirm))
            @include('components.confirm', ['confirm' => $confirm])
        @endif

        @include('components.home.gallery', ["latest" => $latest_image])

        @if (isset($isAdmin))
            @include('components.home.events', ['eventsList' => $eventsList, "isAdmin" => $isAdmin])
        @else
            @include('components.home.events', ['eventsList' => $eventsList, "isAdmin" => false])
        @endif

        @include('components.home.team', ["teamMembers" => $teamMembers])
    </div>
@endsection
