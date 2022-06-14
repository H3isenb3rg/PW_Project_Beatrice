<div class="well panel" style="padding-top: 0">
    <dl class="panel-heading" role="tab" id="heading{{ $event->id }}" style="margin-bottom: 0">
        <dt class="h2">
            {!! trans(date_format(date_create($event->event_date), 'l')) !!}
            {{ date_format(date_create($event->event_date), 'd') }}
            {{ trans(date_format(date_create($event->event_date), 'F')) }}
            <small>
                {{ ucwords($event->venue->name) }}
                ({{ ucwords($event->venue->city) }})
            </small>
        </dt>
        <dd style="border-bottom: 2px solid grey">
            <a class="h3" role="button" data-toggle="collapse" data-parent="#accordion"
                href="#collapse{{ $event->id }}" aria-expanded="true" aria-controls="collapse{{ $event->id }}"
                title="More Info">
                {{ ucwords($event->name) }}
                @include('icons.collapse')
            </a>
        </dd>
    </dl>
    <div id="collapse{{ $event->id }}" class="panel-collapse collapse" role="tabpanel"
        aria-labelledby="heading{{ $event->id }}" style="padding-top: 1%">
        <div class="panel-body" style="padding-top: 0">
            <dl>
                <dt class="h3">{{ ucwords($event->venue->name) }}</dt>
                <dd class="h4">
                    @if (isset($event->venue->maps_link))
                        <a target="_blank" href="{{ $event->venue->maps_link }}" class="btn">
                            @include('icons.location')
                        </a>
                    @else
                        <span title="{{ trans('Link to Maps not available') }}">
                            @include('icons.location')
                        </span>
                    @endif
                    {{ ucwords($event->venue->city) }}
                    <small>{{ ucwords($event->venue->address) }}</small>
                </dd>
                <dd class="h4">{{ ucwords($event->description) }}</dd>
                <dd>
                    <a class="btn btn-primary"
                        href="{{ route('reservation.goToCreate', ['id' => $event->id]) }}">{{ trans('Book') }}</a>
                </dd>
            </dl>
        </div>
    </div>
</div>
