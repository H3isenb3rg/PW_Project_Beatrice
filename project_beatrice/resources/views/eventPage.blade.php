@extends('layouts.master')

@section('title')
    ADj | {{ ucwords($event->name) }}
@endsection

@section('left_navbar')
    <li class=><a href="{{ route('home') }}">@include('icons.home')</a></li>
    <li class="dropdown active">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            {{ trans('labels.events') }} <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('event.index') }}">
                    @include('icons.calendar') {{ trans('labels.calendar') }}
                </a>
            </li>
            <li class="divider"></li>
            <li><a href="{{ route('reservation.index') }}">@include('icons.reservation')
                    {{ trans('labels.myReservations') }}</a>
            </li>
            @if ($isAdmin)
                <li class="divider"></li>
                <li class="active"><a href="{{ route('event.create') }}">@include('icons.newEvent')
                        {{ trans('labels.newEvent') }}</a></li>
            @endif
        </ul>
    </li>
@endsection

@section('right_navbar')
    <li><a><i>{{ trans('labels.welcome') }} {{ $loggedName }}</i></a></li>
    <li><a href="{{ route('user.logout') }}">{{ trans('labels.logout') }} @include('icons.logout')</a></li>
@endsection

@section('breadcrumb')
    <li><a href="{{ route('home') }}">@include('icons.home')</a></li>
    <li><a href="{{ route('event.index') }}">@include('icons.calendar') {{ trans('labels.calendar') }}</a></li>
    <li class="active">{{ trans('Book Event') }}</li>
@endsection

@section('corpo')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @if (isset($alert))
                    @include('components.alert', ['alert' => $alert])
                @endif
                @if (isset($confirm))
                    @include('components.confirm', ['confirm' => $confirm])
                @endif

                <div class="jumbotron">
                    @include('components.book.eventDetails', ['event' => $event])
                    @if (isset($editEvent) && $editEvent)
                        <div class="well">
                            @include('components.book.editEvent', [
                                'event' => $event,
                                'venueList' => $venueList,
                            ])
                        </div>
                    @endif
                    @if (isset($event->available_seats) && $event->available_seats <= 0)
                        <div class="alert alert-info" role="alert">
                            <b>{{ trans('No more seats available') }}</b>
                        </div>
                    @else
                        <div class="well">
                            @include('components.book.bookForm', ['event_id' => $event->id])
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
