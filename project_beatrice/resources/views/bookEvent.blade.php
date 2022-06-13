@extends('layouts.master')

@section('title', 'Arcangelo DJ')

@section('left_navbar')
    <li class=><a href="{{ route('home') }}">@include("icons.home")</a></li>
    <li class="dropdown active">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{ trans('labels.events') }} <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('event.index') }}">
                    @include("icons.calendar") {{ trans('labels.calendar') }}
                </a>
            </li>
            <li class="divider"></li>
            <li><a href="{{ route('event.index') }}">@include("icons.reservation")
                    {{ trans('labels.myReservations') }}</a>
            </li>
            @if ($isAdmin)
                <li class="divider"></li>
                <li class="active"><a href="{{ route('event.create') }}">@include("icons.newEvent") {{ trans('labels.newEvent') }}</a></li>
            @endif
        </ul>
    </li>
@endsection

@section('right_navbar')
    <li><a><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
    <li><a href="{{ route('user.logout') }}">{{ trans('labels.logout') }} @include("icons.logout")</a></li>
@endsection

@section('breadcrumb')
    <li><a href="{{ route('home') }}">@include("icons.home")</a></li>
    <li><a href="{{ route('event.index') }}">@include("icons.calendar") {{ trans('labels.calendar') }}</a></li>
    <li class="active">{{ trans('Book Event') }}</li>
@endsection

@section('corpo')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (isset($alert))
                    @include('components.alert', ['alert' => $alert])
                @endif

                <div class="jumbotron">
                    <h2 style="padding-top: 0">{{ ucwords($event->name) }} <small>{{ ucwords($event->venue->name) }}
                            ({{ ucwords($event->venue->city) }})</small></h2>
                    <dl>
                        <dt class="h4">{{ ucwords($event->venue->name) }}</dt>
                        <dd class="h5">
                            @if (isset($event->venue->maps_link))
                                <a target="_blank" href="{{ $event->venue->maps_link }}" class="">@include("icons.location")</a>
                            @else
                                <span title="{{ trans('Link to Maps not available') }}">
                                    @include("icons.location")
                                </span>
                            @endif
                            {{ ucwords($event->venue->city) }}
                            <small>{{ ucwords($event->venue->address) }}</small>
                        </dd>
                    </dl>
                    <p>{{ $event->description }}</p>
                    <form class="form-horizontal" name="reservation" method="post"
                        action="{{ route('reservation.store') }}">
                        @csrf
                        <div class="form-group">
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon">@include("icons.bookmark")</div>
                                    <input class="form-control" type="text" id="name" name="name"
                                        placeholder="{{ trans('Table Name') }}">
                                    <span id="invalid-title"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="input-group-addon">@include("icons.people")</div>
                                    <input type="number" min="1" max="100" step="1" name="guests" class="form-control"
                                        placeholder="{{ trans('Guests Number') }}">
                                    <span id="invalid-guests"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8">
                                <input type="hidden" name="event_id" value="{{ $event->id }}" />

                                <div class="row">
                                    <div class="col-sm-5" style="padding-top: 1%">
                                        <label for="mySubmit" class="btn btn-primary btn-large btn-block">@include("icons.confirmBook")
                                            {{ trans('Book') }}</label>
                                        <input id="mySubmit" type="submit" value='Save' class="hidden" />
                                    </div>
                                    <div class="col-sm-5" style="padding-top: 1%">
                                        <a href="{{ route('home') }}" role="button"
                                            class="btn btn-danger btn-large btn-block">@include("icons.close")</span> {{ trans('Cancel') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
