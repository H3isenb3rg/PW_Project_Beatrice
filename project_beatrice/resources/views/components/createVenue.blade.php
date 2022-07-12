<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
        <h1 class="panel-title">
            <div class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
                <span class="h1">
                    {{ trans('labels.newVenueTitle') }}
                </span>
            </div>
        </h1>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
            <form name="venue-form" id="venue-form" action="{{ route('venue.create') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div id="venue-name-div" class="form-group">
                            <input id="venue-name" type="text" name="name" class="form-control"
                                placeholder="{{ trans('labels.name') }}">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div id="venue-city-div" class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">@include('icons.city')</div>
                                <input id="venue-city" type="text" name="city" class="form-control"
                                    placeholder="{!! trans('labels.city') !!}">
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div id="venue-maps-div" class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><a href="https://www.google.com/maps/"
                                        target="blank">@include('icons.google')</a></div>
                                <input id="venue-maps" type="url" name="maps" class="form-control"
                                    placeholder="{{ trans('labels.mapsLink') }}">
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div id="venue-address-div" class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">@include('icons.location')</div>
                                <input id="venue-address" type="text" name="address" class="form-control"
                                    placeholder="{{ trans('labels.address') }}">
                            </div>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="mySubmit" class="btn btn-primary btn-block">@include('icons.confirm')
                                {{ trans('Create Venue') }}</label>
                            <input id="mySubmit" type="submit" value="{{ trans('labels.confirm') }}" class="hidden"
                                onclick="event.preventDefault(); checkVenue('{{ $lang }}');" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-warning btn-block" type="button" data-toggle="collapse"
                            data-target="#collapseEdit" aria-expanded="false" aria-controls="collapseExample">
                            {{ __('Edit Venues') }}
                        </button>

                    </div>
                </div>
            </form>
            <div class="collapse" id="collapseEdit">
                <div class="row" style="margin-top: 1em;">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="input-group-addon">@include('icons.location')</div>
                            <select id="venue-to-edit" class="form-control" name="venue_id" onchange="showFillForm();">
                                <option value="none" disabled selected>--
                                    {{ trans('Choose venue to edit') }} --
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
                </div>
                <div class="well hidden" id="edit-venue-well">
                    <form name="edit-venue-form" id="edit-venue-form" action="{{ route('venue.edit') }}"
                        method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="edit-venue-name-div" class="form-group">
                                    <input id="edit-venue-name" type="text" name="name" class="form-control"
                                        placeholder="{{ trans('labels.name') }}">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div id="edit-venue-city-div" class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">@include('icons.city')</div>
                                        <input id="edit-venue-city" type="text" name="city"
                                            class="form-control" placeholder="{!! trans('labels.city') !!}">
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div id="edit-venue-maps-div" class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><a href="https://www.google.com/maps/"
                                                target="blank">@include('icons.google')</a></div>
                                        <input id="edit-venue-maps" type="url" name="maps"
                                            class="form-control" placeholder="{{ trans('labels.mapsLink') }}">
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div id="edit-venue-address-div" class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">@include('icons.location')</div>
                                        <input id="edit-venue-address" type="text" name="address"
                                            class="form-control" placeholder="{{ trans('labels.address') }}">
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input id="venueID" type="hidden" name="venueID" />
                                    <label for="submitEdit"
                                        class="btn btn-primary btn-block">@include('icons.confirm')
                                        {{ __('Confirm') }}</label>
                                    <input id="submitEdit" type="submit" value="{{ __('Confirm') }}"
                                        class="hidden"
                                        onclick="event.preventDefault(); checkVenueEdit('{{ $lang }}');" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
