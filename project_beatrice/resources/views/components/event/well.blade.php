<div class="well panel" style="padding-top: 0; padding-bottom: 0;" >
    <dl class="panel-heading" role="tab" id="heading{{ $event->id }}" style="margin-bottom: 0">
        <dt class="h2">
            {!! trans(date_format(date_create($event->event_date), 'l')) !!}
            {{ (int)date_format(date_create($event->event_date), 'd') }}
            {{ trans(date_format(date_create($event->event_date), 'F')) }}
            <small>
                {{ ucwords($event->venue->name) }}
                ({{ ucwords($event->venue->city) }})
            </small>
        </dt>
        <dd>
            <a class="h3" role="button" data-toggle="collapse" data-parent="#accordion"
                href="#collapse{{ $event->id }}" aria-expanded="true" aria-controls="collapse{{ $event->id }}"
                title="More Info">
                @include('icons.collapse', ["id" => $event->id]) 
                {{ ucwords($event->name) }}
            </a>
        </dd>
    </dl>
    <div id="collapse{{ $event->id }}" class="panel-collapse collapse" role="tabpanel"
        aria-labelledby="heading{{ $event->id }}" style="padding-top: 1%">
        <div class="panel-body" style="padding-top: 0; padding-bottom: 0;">
            <dl>
                <dt class="h3">{{ ucwords($event->venue->name) }} <small>({{ ucwords($event->venue->city) }})</small></dt>
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
                    {{ ucwords($event->venue->address) }}
                </dd>
                <dd class="h4">{!! nl2br($event->description) !!}</dd>
                <dd>
                    @if ($isAdmin)
                        <a class="btn btn-primary" href="{{ route('event.goToDetails', ['id' => $event->id]) }}">{{ trans("Event Page") }}</a>
                    @else
                        <a class="btn btn-primary" href="{{ route('event.goToBook', ['id' => $event->id]) }}">{{ trans('Book') }}</a>
                    @endif
                </dd>
            </dl>
        </div>
    </div>
</div>
