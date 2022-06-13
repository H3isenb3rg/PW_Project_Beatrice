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
                    <form id="event-form" action="{{ route('event.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input required type="text" name="name" class="form-control"
                                placeholder="{{ trans('labels.name') }}">
                        </div>
                        <div class="form-group">
                            <textarea required name="description" rows="3" class="form-control" placeholder="{{ trans('labels.description') }}"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                                <input required type="date" name="date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                <input type="number" min="0" max="999" step="1" name="seats" class="form-control"
                                    placeholder="{{ trans('labels.availableSeats') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span>
                                </div>
                                <select required class="form-control" name="venue_id">
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
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <label for="mySubmit_event" class="btn btn-primary btn-large btn-block"><span
                                            class="glyphicon glyphicon-floppy-save"></span> {{ trans("Confirm") }}</label>
                                    <input id="mySubmit_event" type="submit" value="{{ trans('labels.confirm') }}" class="hidden"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <a href="{{ route('home') }}" class="btn btn-danger btn-block"><span
                                        class="glyphicon glyphicon-log-out"></span> {{ trans("Cancel") }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
