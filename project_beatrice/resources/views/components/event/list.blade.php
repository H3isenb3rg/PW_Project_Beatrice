<div class="row">
    <div class="col-sm-12">
        <h1>{{ trans('labels.next_events') }}</h1>
        <form id="filter-form" name="filter-form" style="margin-top: 2em;">
            @csrf
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group" id="venueFilter_div">
                        <div class="input-group">
                            <div class="input-group-addon">{{ __("Venue") }}</div>
                            <input id="venueFilter" type="text" name="venueFilter" class="form-control"
                            placeholder="{{ __('Venue') }}">
                        </div>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="filter-submit"
                            class="btn btn-primary btn-block">@include('icons.funnel')</label>
                        <input type="submit" id="filter-submit" name="filter-submit" class="hidden"
                            onclick="event.preventDefault(); setFilters()">
                    </div>
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
