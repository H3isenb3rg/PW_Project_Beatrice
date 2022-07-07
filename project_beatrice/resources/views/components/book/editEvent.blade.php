<form class="form-horizontal" id="edit-event-form" name="edit-event-form" action="{{ route('event.edit') }}"
    method="post">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div id="event-name-div" class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">{{ trans('labels.name') }}</div>
                        <input required type="text" name="name" class="form-control" id="event-name"
                            placeholder="{{ trans('labels.name') }}" value="{{ ucwords($event->name) }}">
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="col-sm-3 col-sm-offset-1">
                <div id="event-date-div" class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">@include('icons.calendarPick')</div>
                        <input required id="event-date" type="date" name="date" class="form-control"
                            value="{{ $event->event_date }}">
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>
            <div class="col-sm-3 col-sm-offset-1">
                <div id="event-guests-div" class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">@include('icons.people')</div>
                        <input type="number" min="0" max="999" id="event-guests" step="1"
                            name="seats" class="form-control" placeholder="{{ trans('labels.availableSeats') }}"
                            @if (isset($event->seats) && $event->seats > 0) value = "{{ $event->seats }}" @endif>
                        <div class="input-group-addon">guests</div>
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div id="event-venue-div" class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">@include('icons.location')</div>
                        <select required id="event-venue" class="form-control" name="venue_id">
                            @foreach ($venueList as $venue)
                                <option value="{{ $venue->id }}" @if ($venue->id == $event->venue_id) selected @endif>
                                    {{ ucwords($venue->name) }}
                                    ({{ ucwords($venue->city) }})
                                </option>
                            @endforeach
                        </select>
                        <div class="input-group-addon">{{ __("labels.venue") }}</div>
                    </div>
                    <span class="help-block"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div id="event-description-div" class="form-group">
                    <textarea required id="event-description" name="description" rows="7" class="form-control"
                        placeholder="{{ trans('labels.description') }}">{{ $event->description }}</textarea>
                    <span class="help-block"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="hidden" name="event_id" value="{{ $event->id }}" />
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-4" style="padding-top: 1%">
                                <label for="mySubmit_event"
                                    class="btn btn-primary btn-large btn-block">@include('icons.confirm')
                                    {{ trans('Confirm Edit') }}</label>
                                <input id="mySubmit_event" type="submit" value="{{ trans('labels.confirm') }}"
                                    class="hidden" {{-- onclick="event.preventDefault(); checkEvent('{{ $lang }}')" --}} />
                            </div>
                            <div class="col-sm-4" style="padding-top: 1%">
                                <a href="{{ route('event.goToDetails', ['id' => $event->id]) }}"
                                    class="btn btn-danger btn-block">@include('icons.close')
                                    {{ trans('Cancel') }}</a>
                            </div>
                            <div class="col-sm-4" style="padding-top: 1%">
                                @include('components.event.deleteWmodal', ['event' => $event])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
