<div class="well" style="padding-top: 0">
    <dl style="margin-bottom: 0" role="button" data-toggle="collapse" href="#details{{ $event->id }}"
        aria-controls="details{{ $event->id }}" title="More Info">
        <dt class="h2">
            {!! trans(date_format(date_create($event->event_date), 'l')) !!}
            {{ date_format(date_create($event->event_date), 'd') }}
            {{ trans(date_format(date_create($event->event_date), 'F')) }}
            <small>
                {{ ucwords($event->venue->name) }}
                ({{ ucwords($event->venue->city) }})
            </small>
        </dt>
        <dd class="h3" style="border-bottom: 2px solid grey">{{ ucwords($event->name) }}</dd>
        <dd>
            <a class="btn btn-default" role="button" data-toggle="collapse" href="#details{{ $event->id }}"
                aria-controls="details{{ $event->id }}" title="More Info">
                @include("icons.collapse")
            </a>
        </dd>
    </dl>
    <div class="collapse" id="details{{ $event->id }}" style="padding-top: 1%">
        <dl>
            <dt class="h3">{{ ucwords($event->venue->name) }}</dt>
            <dd class="h4">
                @if (isset($event->venue->maps_link))
                    <a target="_blank" href="{{ $event->venue->maps_link }}" class="btn">
                        @include("icons.location")    
                    </a>
                @else
                    <span title="{{ trans('Link to Maps not available') }}">
                        @include("icons.location")
                    </span>
                @endif
                {{ ucwords($event->venue->city) }}
                <small>{{ ucwords($event->venue->address) }}</small>
            </dd>
            <dd class="h4">{{ ucwords($event->description) }}</dd>
            <dd>
                <a class="btn btn-primary" href="{{ route("reservation.goToCreate", ["id" => $event->id]) }}">{{ trans("Book") }}</a>
            </dd>
        </dl>
    </div>
</div>
