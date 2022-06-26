<div class="row">
    <div class="col-sm-12">
        <h1>{{ trans('labels.next_events') }}</h1>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach ($eventsList as $event)
                @include('components.event.well', ['event' => $event])
            @endforeach
        </div>
        @include('icons.svg.180-ring-loading')
    </div>
</div>
