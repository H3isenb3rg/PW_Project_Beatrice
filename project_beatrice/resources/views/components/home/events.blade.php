<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron" style="padding-top: 0">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ trans('labels.next_events') }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav nav-pills nav-justified">
                        <li role="presentation">
                            <a href="{{ route('event.index') }}"><span class="glyphicon glyphicon-calendar"></span>
                                {{ trans('labels.calendar') }}</a>
                        </li>
                        @if ($logged)
                            <li role="presentation">
                                <a href="{{ route('event.index') }}"><span class="glyphicon glyphicon-time"></span>
                                    {{ trans('labels.myReservations') }}</a>
                            </li>
                            @if ($isAdmin)
                                <li role="presentation">
                                    <a href="{{ route('event.create') }}"><span
                                            class="glyphicon glyphicon-plus-sign"></span>
                                        {{ trans('labels.newEvent') }}</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    @foreach ($eventsList as $event)
                        @include('components.event.well', ['event' => $event])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
