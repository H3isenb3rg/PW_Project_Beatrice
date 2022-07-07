<div class="well panel" style="padding-top: 0; padding-bottom: 0;">
    <dl class="panel-heading" role="tab" id="heading{{ $event->id }}" style="margin-bottom: 0">
        <dt class="h2">
            {!! trans(date_format(date_create($event->event_date), 'l')) !!}
            {{ (int) date_format(date_create($event->event_date), 'd') }}
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
                @include('icons.collapse', ['id' => $event->id])
                {{ ucwords($event->name) }}
            </a>
        </dd>
    </dl>
    <div id="collapse{{ $event->id }}" class="panel-collapse collapse" role="tabpanel"
        aria-labelledby="heading{{ $event->id }}" style="padding-top: 1%">
        <div class="panel-body" style="padding-top: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>
                            {{ ucwords($event->venue->name) }} <small>({{ ucwords($event->venue->city) }})</small>
                        </h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h4>
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
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h4>
                            {!! nl2br($event->description) !!}
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <a class="btn btn-primary btn-block" href="{{ route('event.goToDetails', ['id' => $event->id]) }}">@include('icons.journal')
                            {{ trans('Event Page') }}</a>
                    </div>
                    @if ($isAdmin)
                    <div class="col-sm-4">
                        @include('components.event.deleteWmodal', ['event' => $event])
                    </div> 
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
