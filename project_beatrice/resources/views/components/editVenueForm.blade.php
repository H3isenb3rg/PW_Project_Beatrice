<form name="edit-venue{{ $venue->id }}-form" id="edit-venue{{ $venue->id }}-form" action="{{ route('venue.edit') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div id="edit-venue-name-div" class="form-group">
                <input id="edit-venue-name" type="text" name="name" class="form-control"
                    placeholder="{{ trans('labels.name') }}"
                    value="{{ $venue->name }}">
                <span class="help-block"></span>
            </div>
        </div>
        <div class="col-sm-3">
            <div id="edit-venue-city-div" class="form-group">
                <div class="input-group">
                    <div class="input-group-addon">@include('icons.city')</div>
                    <input id="edit-venue-city" type="text" name="city" class="form-control"
                        placeholder="{!! trans('labels.city') !!}"
                        value="{{ ucwords($venue->city) }}">
                </div>
                <span class="help-block"></span>
            </div>
        </div>
        <div class="col-sm-3">
            <div id="edit-venue-maps-div" class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><a href="https://www.google.com/maps/"
                            target="blank">@include('icons.google')</a></div>
                    <input id="edit-venue-maps" type="url" name="maps" class="form-control"
                        placeholder="{{ trans('labels.mapsLink') }}"
                        @isset($venue->maps_link)
                            value="{{ $venue->maps_link }}"
                        @endisset>
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
                    <input id="edit-venue-address" type="text" name="address" class="form-control"
                        placeholder="{{ trans('labels.address') }}"
                        value="{{ $venue->address }}">
                </div>
                <span class="help-block"></span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input id="vanueID" type="hidden" name="venueID"
                value="{{ $venue->id }}" />
                <label for="mySubmit"
                    class="btn btn-primary btn-block">@include('icons.confirm')
                    {{ __("Confirm") }}</label>
                <input id="mySubmit" type="submit" value="{{ __("Confirm") }}" class="hidden"
                    onclick="event.preventDefault(); checkVenueEdit('{{ $lang }}', 'edit-venue{{ $venue->id }}-form');" />
            </div>
        </div>
    </div>
</form>