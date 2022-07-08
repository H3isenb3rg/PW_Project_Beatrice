<div class="row">
    <div class="col-sm-12">
        <h1>{{ trans('labels.next_events') }}</h1>
        <form id="filter-form" name="filter-form" style="margin-top: 2em;">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group" id="venueFilter_div">
                        <div class="input-group">
                            <div class="input-group-addon">@include('icons.location')</div>
                            <select required id="venueFilter" class="form-control" name="venueFilter" onchange="filterVenue()">
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
                </div>
                <div class="col-sm-1">
                    <a type="button" class="btn btn-primary btn-block" href="{{ route('event.index') }}">@include("icons.reload")</a>
                </div>
            </div>
        </form>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach ($eventsList as $event)
                @include('components.event.well', ['event' => $event])
            @endforeach
        </div>
        @include('icons.svg.180-ring-loading')
    </div>
</div>
