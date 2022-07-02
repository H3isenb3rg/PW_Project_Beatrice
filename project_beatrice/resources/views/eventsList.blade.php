@extends('layouts.master')

@section('title')
    ADJ | {{ trans('labels.calendar') }}
@endsection


@section('scripts')
    <script src="{{ url('/') }}/js/event_well.js"></script>
    <script src="{{ url('/') }}/js/showFillDelete.js"></script>
    <script>
        var has_more = true;

        function load_events(sync_type) {
            // ajax call to get next events data
            $.ajax({

                type: 'GET',

                url: '/ajaxFetchNextEvents',

                data: '_token = {{ csrf_token() }}',

                async: sync_type,

                success: function(data) {
                    // console.log(data);

                    if (parseInt(data.count) > 0) {
                        for (well in data.wells) {
                            $("#accordion").append(data.wells[well]);
                        }

                        if (parseInt(data.count) < 5) {
                            has_more = false;
                            $(window).unbind("scroll");
                        }
                    } else {
                        has_more = false;
                        $(window).unbind("scroll");
                    }

                    $("#loading-div").hide();
                }
            });
        }

        $(document).ready(function() {
            // If the window height 
            while (($(document).height() <= $(window).height()) && has_more) {
                load_events(false);
            }
            $("#loading-div").hide();

            var scrollTimer = null;
            $(window).scroll(function() {
                if (scrollTimer) {
                    clearTimeout(scrollTimer); // clear previous timer
                }

                // set timer while we wait for a pause in scroll events
                scrollTimer = setTimeout(function() {
                    scrollTimer = null; // timer done here
                    if (!$("#loading-div").is(':visible') && (window.innerHeight + Math.ceil(window
                            .pageYOffset)) >= document.body.offsetHeight) {
                        $("#loading-div").show();
                        load_events(true);
                    }
                }, 250);
            })
        });
    </script>
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
    <div id="whiteContainer" class="container" style="margin-bottom: 7.5em;">
        @include('components.event.list', ['eventsList' => $eventsList])
    </div>
@endsection
