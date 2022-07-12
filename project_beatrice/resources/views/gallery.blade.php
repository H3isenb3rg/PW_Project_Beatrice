@extends('layouts.master')

@section('title')
    ADJ | {{ trans('labels.jumbotronGalleryButton') }}
@endsection


@section('scripts')
@endsection

@section('left_navbar')
    <li><a href="{{ route('home') }}">@include('icons.home')</a></li>
    <li class="active"><a>@include('icons.images')</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle active" data-toggle="dropdown">{{ trans('labels.events') }} <b
                class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="{{ route('event.index') }}"> @include('icons.calendar')</span>
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
    <li class="active">@include('icons.images')</li>
@endsection

@section('corpo')
    @if (isset($alert))
        @include('components.alert', ['alert' => $alert])
    @endif

    @if (isset($confirm))
        @include('components.confirm', ['confirm' => $confirm])
    @endif
    
    <div id="whiteContainer" class="container" style="margin-bottom: 7.5em;">
        @include('components.gallery.page', [
            "carousel" => $carousel
        ])
    </div>
@endsection
