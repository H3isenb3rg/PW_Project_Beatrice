<!-- Button trigger modal -->
<a type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#myModal{{ $event->id }}">
    @include('icons.calendarX') {{ trans('Delete Event') }}
</a>

<!-- Modal -->
<div class="modal fade" id="myModal{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ __('Confirm Delete') }}</h4>
            </div>
            <div class="modal-body">
                <dl class="dl-horizontal">
                    <dt>{{ __('labels.name') }}</dt>
                    <dd>{{ $event->name }}</dd>
                    <dt>{{ __('labels.date') }}</dt>
                    <dd>{!! trans(date_format(date_create($event->event_date), 'l')) !!}
                        {{ (int) date_format(date_create($event->event_date), 'd') }}
                        {{ trans(date_format(date_create($event->event_date), 'F')) }}</dd>
                    <dt>{{ __('labels.venue') }}</dt>
                    <dd>{{ ucwords($event->venue->name) }}
                        ({{ ucwords($event->venue->city) }})</dd>
                        <dt>{{ __("Reservations") }}</dt><dd id="reservations-count">@include('icons.svg.3-dots-bounce')</dd>
                        <dt>{{ __("Guests booked") }}</dt><dd id="guests-count">@include('icons.svg.3-dots-bounce')</dd>
                </dl>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-danger btn-block" href="{{ route("event.destroy", ["id"=>$event->id]) }}">{{ __('Delete Event') }}</a>
            </div>
        </div>
    </div>
</div>
