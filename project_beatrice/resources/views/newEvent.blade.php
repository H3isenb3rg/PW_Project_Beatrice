@extends('layouts.master')

@section('title', 'Arcangelo DJ')

@section('scripts')
    <script src="{{ url('/') }}/js/form_check/newEvent.js"></script>
    <script src="{{ url('/') }}/js/form_check/newVenue.js"></script>
@endsection

@section('left_navbar')
    <li class=><a href="{{ route('home') }}">@include("icons.home")</a></li>
    <li class="dropdown active">
        <a href="#" class="dropdown-toggle active" data-toggle="dropdown">{{ trans('labels.events') }} <b
                class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('event.index') }}">@include("icons.calendar") {{ trans('labels.calendar') }}</a></li>
            <li class="divider"></li>
            <li><a href="{{ route('event.index') }}">@include("icons.reservation")
                    {{ trans('labels.myReservations') }}</a>
            </li>
            <li class="divider"></li>
            <li class="active"><a href="{{ route('event.create') }}">@include("icons.newEvent") {{ trans('labels.newEvent') }}</a></li>
        </ul>
    </li>
@endsection

@section('right_navbar')
    <li><a><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
    <li><a href="{{ route('user.logout') }}">{{ trans('labels.logout') }} @include("icons.logout")</a></li>
@endsection

@section('breadcrumb')
    <li><a href="{{ route('home') }}">@include("icons.home")</a></li>
    <li class="active">@include("icons.newEvent") {{ trans('labels.newEvent') }}</li>
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
