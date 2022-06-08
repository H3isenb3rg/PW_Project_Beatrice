@extends('layouts.master')

@section('title', 'Arcangelo DJ')

@section('left_navbar')
    <li class=><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home"></span></a></li>
    <li class="dropdown active">
        <a href="#" class="dropdown-toggle active" data-toggle="dropdown">{{ trans('labels.events') }} <b
                class="caret"></b></a>
        <ul class="dropdown-menu">
            <li class="active"><a href="{{ route('event.index') }}"><span
                        class="glyphicon glyphicon-calendar"></span>
                    {{ trans('labels.calendar') }}</a></li>
            @if ($logged)
                <li class="divider"></li>
                <li><a href="{{ route('event.index') }}"><span class="glyphicon glyphicon-time"></span>
                        {{ trans('labels.myReservations') }}</a>
                </li>
                @if ($isAdmin)
                    <li class="divider"></li>
                    <li><a href="{{ route('event.create') }}"><span class="glyphicon glyphicon-plus-sign"></span>
                            {{ trans('labels.newEvent') }}</a></li>
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
    <li class="active"><span class="glyphicon glyphicon-calendar"></span>{{ trans('labels.calendar') }}</li>
@endsection

@section('corpo')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table id="example" class="table table-striped table-hover table-responsive" style="width:100%">
                <col width='20%'>
                <col width='30%'>
                <col width='40%'>
                <col width='10%'>
                <col width='0%' hidden>
                <thead>
                    <tr>
                        <th>{{ trans("labels.date") }}</th>
                        <th>{{ trans("labels.name") }}</th>
                        <th>{{ trans("labels.venue") }}</th>
                        <th></th>
                        <th hidden></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($eventsList as $event)
                        <tr>
                            <td> {{ $event->event_date }} </td>
                            <td> {{ ucwords($event->name) }} </td>
                            <td> {{ ucwords($event->venue->name) }} ({{ ucwords($event->venue->city) }}) </td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('event.info', ['event' => $event->id]) }}">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                </a>
                            </td>
                            <td hidden> {{ $event->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
