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
                @if (isset($confirm))
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        {{ $confirm }}
                    </div>
                @endif

                @if (isset($alert))
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        {!! $alert !!}
                    </div>
                @endif

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h1 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                    href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    {{ trans('labels.newVenueTitle') }}
                                </a>
                            </h1>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
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
                                                        <input type="submit" name="login-submit"
                                                            class="form-control btn btn-primary"
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
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h1 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                    aria-expanded="false" aria-controls="collapseTwo">
                                    {{ trans('labels.newEventTitle') }}
                                </a>
                            </h1>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel"
                            aria-labelledby="headingTwo">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <form id="venue-form" action="{{ route('event.create') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control"
                                                    placeholder="{{ trans('labels.name') }}">
                                            </div>
                                            <div class="form-group">
                                                <textarea name="description" rows="3" class="form-control" placeholder="{{ trans('labels.description') }}"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon"><span
                                                            class="glyphicon glyphicon-calendar"></span></div>
                                                    <input type="datetime-local" name="date" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon"><span
                                                            class="glyphicon glyphicon-user"></span></div>
                                                    <input type="number" min="0" max="999" step="1" name="seats"
                                                        class="form-control"
                                                        placeholder="{{ trans('labels.availableSeats') }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon"><span
                                                            class="glyphicon glyphicon-map-marker"></span></div>
                                                    <select class="form-control" name="author_id">
                                                        <option value="" disabled selected>--
                                                            {{ trans('labels.chooseVenue') }} --
                                                        </option>
                                                        @foreach ($venueList as $venue)
                                                            <option value="{{ $venue->id }}">
                                                                {{ ucwords($venue->name) }}
                                                                ({{ ucwords($venue->city) }})
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-sm-offset-3">
                                                        <input type="submit" name="login-submit"
                                                            class="form-control btn btn-primary"
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
                </div>
            </div>
        </div>
    </div>
@endsection
