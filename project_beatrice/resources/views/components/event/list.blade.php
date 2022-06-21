<div class="row">
    <div class="col-sm-12">
        <h1>{{ trans('labels.next_events') }}</h1>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach ($eventsList as $event)
                @include('components.event.well', ['event' => $event])
            @endforeach
        </div>
        {{ $eventsList->links() }}
        <nav aria-label="...">
            <ul class="pager">
                <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Older</a></li>
                <li class="next"><a href="#">Newer <span aria-hidden="true">&rarr;</span></a></li>
            </ul>
        </nav>
    </div>
</div>
