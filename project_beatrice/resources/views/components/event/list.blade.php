<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron" style="padding-top: 0">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ trans("labels.next_events") }}</h1>

                    @foreach ($eventsList as $event)
                        
                        @include(
                            "components.event.well",
                            ["event"=>$event]
                        )
                        
                    @endforeach
            </div>
        </div>
    </div>
</div>