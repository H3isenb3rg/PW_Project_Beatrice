@extends('layouts.master')

@section('title', 'Arcangelo DJ')

@section('left_navbar')
    <li class=><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="dropdown active">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{ trans('labels.events') }} <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('event.index') }}">
                    <span class="glyphicon glyphicon-calendar"></span> {{ trans('labels.calendar') }}
                </a>
            </li>
            <li class="divider"></li>
            <li><a href="{{ route('event.index') }}"><span class="glyphicon glyphicon-time"></span>
                    {{ trans('labels.myReservations') }}</a>
            </li>
            @if ($isAdmin)
                <li class="divider"></li>
                <li class="active"><a href="{{ route('event.create') }}"><span
                            class="glyphicon glyphicon-plus-sign"></span> {{ trans('labels.newEvent') }}</a></li>
            @endif
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
    <li><a href="{{ route('event.index') }}"><span
                class="glyphicon glyphicon-calendar"></span>{{ trans('labels.calendar') }}</a></li>
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
                    <h1>{{ trans('Book Event') }}</h1>
                    <form class="form-horizontal" name="reservation" method="post"
                        action="{{ route('reservation.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-md-2">{{ trans('Table Name') }}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="{{ trans('Table Name') }}">
                                <span id="invalid-title"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="guests" class="col-md-2">{{ trans('Guests Number') }}</label>
                            <div class="col-sm-10">
                                <input type="number" min="1" max="100" step="1" name="guests" class="form-control"
                                    placeholder="{{ trans('Guests Number') }}">
                                <span id="invalid-guests"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <input type="hidden" name="event_id" value="{{ $event_id }}" />
                                <label for="mySubmit" class="btn btn-primary btn-large btn-block"><span
                                        class="glyphicon glyphicon-floppy-save"></span> {{ trans("Confirm") }}</label>
                                <input id="mySubmit" type="submit" value='Save' class="hidden"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <a href="{{ route('home') }}" class="btn btn-danger btn-large btn-block"><span
                                        class="glyphicon glyphicon-log-out"></span> {{ trans("Cancel") }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
