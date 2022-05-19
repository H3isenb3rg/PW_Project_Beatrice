@extends('layouts.master')

@section('title', 'Arcangelo DJ')

@section('left_navbar')
    <li class=><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="dropdown active">
        <a href="#" class="dropdown-toggle active" data-toggle="dropdown">{{ trans('labels.events') }} <b
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
                    <li class="active"><a href="{{ route('event.create') }}"><span
                                class="glyphicon glyphicon-plus-sign"></span> {{ trans('labels.newEvent') }}</a></li>
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
    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span></a></li>
    <li><a class="active"><span class="glyphicon glyphicon-plus-sign"></span> {{ trans('labels.newEvent') }}</a>
    </li>
@endsection

@section('corpo')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                {!! $confirm !!}
                <div class="jumbotron">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1>{{ trans('labels.newVenueTitle') }}</h1>
                            <form id="venue-form" action="{{ route('venue.create') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="{{ trans('labels.name') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="city" class="form-control"
                                        placeholder="{!! trans('labels.city') !!}">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="address" class="form-control"
                                        placeholder="{{ trans('labels.address') }}">
                                </div>
                                <div class="form-group">
                                    <input type="url" name="maps" class="form-control"
                                        placeholder="{{ trans('labels.mapsLink') }}">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" class="form-control btn btn-primary"
                                                value="{{ trans('labels.confirm') }}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="jumbotron">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ trans('labels.newEventTitle') }}</h1>
                    <form id="venue-form" action="{{ route('event.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control"
                                placeholder="{{ trans('labels.name') }}">
                        </div>
                        <div class="form-group">
                            <textarea name="description" rows="3" class="form-control"
                                placeholder="{{ trans('labels.description') }}"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                <input type="datetime-local" name="date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="number" min="0" max="999" step="1" name="seats" class="form-control"
                                placeholder="{{ trans('labels.availableSeats') }}">
                        </div>
                        <p>-- Scegli venue Coming Soon --</p>
                        <!-- Qui dropdown dinamica con venue -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <input type="submit" name="login-submit" class="form-control btn btn-primary"
                                        value="{{ trans('labels.confirm') }}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
