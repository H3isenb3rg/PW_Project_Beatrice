<div class="well panel" style="padding-top: 0; padding-bottom: 0;">
    <div class="row">
        <div class="col-sm-7">
            <h2>
                {!! trans(date_format(date_create($reservation->event->event_date), 'l')) !!}
                {{ date_format(date_create($reservation->event->event_date), 'd') }}
                {{ trans(date_format(date_create($reservation->event->event_date), 'F')) }}
            </h2>
        </div>
        <div class="col-sm-3">
            <h3>
                @include('icons.user') {{ ucwords($reservation->name) }}
            </h3>
        </div>
        <div class="col-sm-2">
            <h3>
                @include('icons.people') {{ $reservation->guests }}
            </h3>
        </div>

    </div>
    <div class="row panel-heading" role="tab" id="heading{{ $reservation->id }}" style="margin-bottom: 0">
        <a class="h3" role="button" data-toggle="collapse" data-parent="#accordion"
            href="#collapse{{ $reservation->id }}" aria-expanded="true"
            aria-controls="collapse{{ $reservation->id }}" title="More Info">
            @include('icons.collapse', ['id' => $reservation->id])
            {{ ucwords($reservation->event->name) }}
        </a>
        </dd>
        <div id="collapse{{ $reservation->id }}" class="panel-collapse collapse" role="tabpanel"
            aria-labelledby="heading{{ $reservation->id }}" style="padding-top: 1%">
            <div class="panel-body" style="padding-top: 0; padding-bottom: 0;">
                <dl>
                    <dt class="h3">{{ ucwords($reservation->event->venue->name) }}
                        <small>({{ ucwords($reservation->event->venue->city) }})</small>
                    </dt>
                    <dd class="h4">
                        @if (isset($reservation->event->venue->maps_link))
                            <a target="_blank" href="{{ $reservation->event->venue->maps_link }}" class="btn">
                                @include('icons.location')
                            </a>
                        @else
                            <span title="{{ trans('Link to Maps not available') }}">
                                @include('icons.location')
                            </span>
                        @endif
                        {{ ucwords($reservation->event->venue->address) }}
                    </dd>
                </dl>
            </div>
        </div>
    </div>
