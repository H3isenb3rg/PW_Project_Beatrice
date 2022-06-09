<div class="well" style="padding-top: 0">
    <dl style="margin-bottom: 0">
        <dt class="h2">
            {!! trans(date_format(date_create($event->event_date), 'l')) !!}
            {{ date_format(date_create($event->event_date), 'd') }}
            {{ trans(date_format(date_create($event->event_date), 'F')) }}
            <small>{{ ucwords($event->venue->name) }} ({{ ucwords($event->venue->city) }})</small>
        </dt>
        <dd class="h3" style="border-bottom: 2px solid grey">{{ ucwords($event->name) }}</dd>
        <dd class="h4">{{ ucwords($event->description) }}</dd>
    </dl>
</div>
