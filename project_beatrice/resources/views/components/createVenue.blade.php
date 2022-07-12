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
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div id="venue-maps-div" class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><a href="https://www.google.com/maps/"
                                        target="blank">@include('icons.google')</a></div>
                                <input id="venue-maps" type="url" name="maps" class="form-control"
                                    placeholder="{{ trans('labels.mapsLink') }}">
                                <span class="help-block"></span>
                            </div>
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
                                <span class="help-block"></span>
                            </div>
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
                @foreach ($venueList as $venue)
                    <div class="well">
                        @include('components.editVenueForm')
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
