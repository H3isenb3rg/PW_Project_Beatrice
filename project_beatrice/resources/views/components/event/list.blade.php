<div class="row">
    <div class="col-sm-12">
        <h1>{{ trans('labels.next_events') }}</h1>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach ($eventsList->items() as $event)
                @include('components.event.well', ['event' => $event])
            @endforeach
        </div>
        <nav aria-label="...">
            <ul class="pager">
                @if (!$eventsList->onFirstPage())
                    @php($first_event = $eventsList->items()[0])
                    @php($first_date = __(date_format(date_create($first_event->event_date), 'l')) . ' ' . (int) date_format(date_create($first_event->event_date), 'd') . ' ' . __(date_format(date_create($first_event->event_date), 'F')))
                    <li class="previous"><a href="{{ $eventsList->previousPageUrl() }}"><span
                                aria-hidden="true">&larr;</span> {{ __('Before') }} {!! $first_date !!}</a></li>
                @endif
                @if (!$eventsList->onLastPage())
                    @php($last_event = $eventsList->items()[$eventsList->count() - 1])
                    @php($last_date = __(date_format(date_create($last_event->event_date), 'l')) . ' ' . (int) date_format(date_create($last_event->event_date), 'd') . ' ' . __(date_format(date_create($last_event->event_date), 'F')))
                    <li class="next"><a href="{{ $eventsList->nextPageUrl() }}">{{ __('After') }}
                            {!! $last_date !!}
                            <span aria-hidden="true">&rarr;</span></a></li>
                @endif
            </ul>
        </nav>
    </div>
</div>
