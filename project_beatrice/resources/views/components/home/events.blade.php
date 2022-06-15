<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ trans('labels.next_events') }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <ul class="nav nav-pills nav-justified">
                        <li role="presentation">
                            <a href="{{ route('event.index') }}">@include('icons.calendar')
                                {{ trans('labels.calendar') }}</a>
                        </li>
                        @if ($logged)
                            <li role="presentation">
                                <a href="{{ route('event.index') }}">@include('icons.reservation')
                                    {{ trans('labels.myReservations') }}</a>
                            </li>
                            @if ($isAdmin)
                                <li role="presentation">
                                    <a href="{{ route('event.create') }}">@include('icons.newEvent')
                                        {{ trans('labels.newEvent') }}</a>
                                </li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach ($eventsList as $event)
                            @include('components.event.well', ['event' => $event, "isAdmin" => $isAdmin])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
