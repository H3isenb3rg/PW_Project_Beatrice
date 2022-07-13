<div class="item {{ $is_active }}">
    <img class="img-responsive" src="{{ url('/') }}/img/gallery/{{ $image->path }}" alt="{{ $image->path }}">
    <div class="carousel-caption">
        {!! trans(date_format(date_create($image->created_at), 'l')) !!}
            {{ (int) date_format(date_create($image->created_at), 'd') }}
            {{ trans(date_format(date_create($image->created_at), 'F')) }}
    </div>
</div>