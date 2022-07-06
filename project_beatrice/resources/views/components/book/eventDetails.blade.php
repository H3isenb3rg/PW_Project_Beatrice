<div class="row">
    <div class="col-sm-12">
        <h2>{{ ucwords($event->name) }}</h2>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <h3>
            @include('icons.calendar')
            {!! trans(date_format(date_create($event->event_date), 'l')) !!}
            {{ date_format(date_create($event->event_date), 'd') }}
            {{ trans(date_format(date_create($event->event_date), 'F')) }}
        </h3>
    </div>
    <div class="col-sm-8">
        <h3>
            @if (isset($event->venue->maps_link))
                <a target="_blank" href="{{ $event->venue->maps_link }}" class="">@include('icons.location')</a>
            @else
                <span title="{{ trans('Link to Maps not available') }}">
                    @include('icons.location')
                </span>
            @endif
            {{ ucwords($event->venue->city) }}
            <small>{{ ucwords($event->venue->address) }}</small>
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h4>
            {!! nl2br($event->description) !!}
        </h4>
    </div>
</div>
