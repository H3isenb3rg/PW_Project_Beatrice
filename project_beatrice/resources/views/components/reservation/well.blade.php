<div class="well panel" style="padding-top: 0; padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h2>
                    {!! trans(date_format(date_create($reservation->event->event_date), 'l')) !!}
                    {{ date_format(date_create($reservation->event->event_date), 'd') }}
                    {{ trans(date_format(date_create($reservation->event->event_date), 'F')) }}
                </h2>
            </div>
            <div class="col-sm-2 col-xs-6">
                <h3>
                    @include('icons.user') {{ ucwords($reservation->name) }}
                </h3>
            </div>
            <div class="col-sm-2 col-xs-2">
                <h3>
                    @include('icons.people') {{ $reservation->guests }}
                </h3>
            </div>
            <div class="col-sm-2 col-xs-2">
                @include('components.reservation.editWmodal', ["reservation" => $reservation])
            </div>
            <div class="col-sm-1 col-xs-1">
                <h3>
                    <a type="button" title="{{ __("Add to Calendar") }}" onclick='create_download_ics(
                        "{{ $reservation->event->name }}", 
                        "{{ $reservation->name }} - {{ $reservation->guests }}", 
                        "{{ $reservation->event->venue->name }}", 
                        "{{ $reservation->event->event_date }}", 
                        "{{ $reservation->event->event_date }}"
                        )'>
                        @include('icons.newEvent')
                    </a>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="panel-heading" role="tab" id="heading{{ $reservation->id }}"
                    style="margin-bottom: 0; padding-left: 0;">
                    <a class="h3" role="button" data-toggle="collapse" data-parent="#accordion"
                        href="#collapse{{ $reservation->id }}" aria-expanded="true"
                        aria-controls="collapse{{ $reservation->id }}" title="More Info">
                        @include('icons.collapse', ['id' => $reservation->id])
                        {{ ucwords($reservation->event->name) }}
                        <small>{{ ucwords($reservation->event->venue->name) }}</small>
                    </a>
                </div>
            </div>
        </div>
        <div id="collapse{{ $reservation->id }}" class="panel-collapse collapse" role="tabpanel"
            aria-labelledby="heading{{ $reservation->id }}">
            <div class="panel-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>
                                {{ ucwords($reservation->event->venue->city) }}
                                @if (isset($reservation->event->venue->maps_link))
                                    <a target="_blank" href="{{ $reservation->event->venue->maps_link }}"
                                        class="btn">
                                        @include('icons.location')
                                    </a>
                                @else
                                    <span title="{{ trans('Link to Maps not available') }}">
                                        @include('icons.location')
                                    </span>
                                @endif
                                <small>{{ ucwords($reservation->event->venue->address) }}</small>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
