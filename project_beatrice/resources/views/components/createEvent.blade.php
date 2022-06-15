<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
        <h1 class="panel-title">
            <div role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false"
                aria-controls="collapseTwo">
                <span>
                    {{ trans('labels.newEventTitle') }}
                </span>
            </div>
        </h1>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <form id="event-form" name="event-form" action="{{ route('event.create') }}" method="post" onload="set_current_date">
                        @csrf
                        <div id="event-name-div" class="form-group">
                            <input required type="text" name="name" class="form-control" id="event-name"
                                placeholder="{{ trans('labels.name') }}">
                            <span class="help-block"></span>
                        </div>
                        <div id="event-description-div" class="form-group">
                            <textarea required id="event-description" name="description" rows="3" class="form-control" placeholder="{{ trans('labels.description') }}"></textarea>
                            <span class="help-block"></span>
                        </div>
                        <div id="event-date-div" class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">@include('icons.calendarPick')</div>
                                <input required id="event-date" type="date" name="date" class="form-control">
                            </div>
                            <span class="help-block"></span>
                        </div>
                        <div id="event-guests-div" class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">@include('icons.people')</div>
                                <input type="number" min="0" max="999" id="event-guests" step="1" name="seats" class="form-control"
                                    placeholder="{{ trans('labels.availableSeats') }}">
                            </div>
                            <span class="help-block"></span>
                        </div>
                        <div id="event-venue-div" class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">@include('icons.location')</div>
                                <select required id="event-venue" class="form-control" name="venue_id">
                                    <option value="" disabled selected>--
                                        {{ trans('labels.chooseVenue') }} --
                                    </option>
                                    @foreach ($venueList as $venue)
                                        <option value="{{ $venue->id }}">
                                            {{ ucwords($venue->name) }}
                                            ({{ ucwords($venue->city) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-5" style="padding-top: 1%">
                                        <label for="mySubmit_event"
                                        class="btn btn-primary btn-large btn-block">@include('icons.confirm')
                                        {{ trans("Create Event") }}</label>
                                    <input id="mySubmit_event" type="submit" value="{{ trans('labels.confirm') }}"
                                        class="hidden"
                                        onclick="event.preventDefault(); checkEvent('{{ $lang }}')" />
                                    </div>
                                    <div class="col-sm-5" style="padding-top: 1%">
                                        <a href="{{ route('home') }}"
                                        class="btn btn-danger btn-block">@include('icons.close')
                                        {{ trans('Cancel') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
