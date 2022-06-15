<h2 style="margin-top: 0">{{ ucwords($event->name) }} <small>{{ ucwords($event->venue->name) }}
        ({{ ucwords($event->venue->city) }})</small></h2>
<dl>
    <dt class="h4">{{ ucwords($event->venue->name) }}</dt>
    <dd class="h4">
        @if (isset($event->venue->maps_link))
            <a target="_blank" href="{{ $event->venue->maps_link }}"
                class="">@include('icons.location')</a>
        @else
            <span title="{{ trans('Link to Maps not available') }}">
                @include('icons.location')
            </span>
        @endif
        {{ ucwords($event->venue->city) }}
        <small>{{ ucwords($event->venue->address) }}</small>
    </dd>
    <dd class="h4">{{ $event->description }}</dd>
</dl>
