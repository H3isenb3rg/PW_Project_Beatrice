<div class="row">
    <div class="col-sm-12">
        <h1>{{ trans('labels.jumbotronGalleryButton') }}</h1>
    </div>
</div>
@if (isset($isAdmin) && $isAdmin)
    <div class="row" style="margin-bottom: 2em;">
        <div class="col-sm-12">
            @include("components.gallery.form")
        </div>
    </div>
@endif
<div class="row" style="margin-bottom: 2em">
    <div class="col-sm-12">
        @include("components.gallery.carousel", [
            "images" => $carousel
        ])
    </div>
</div>
@if (isset($images))
<div class="row">
    @foreach ($images as $image)
        <div class="col-sm-4 col-xs-6">
            <div class="col-sm-12" style="margin: 0">
                <img class="img-responsive img-rounded" src="{{ url('/') }}/img/gallery/{{ $image->path }}"
                    alt="{{ $image->path }}">
                <div class="caption">
                    <h2 class="text-center bold"><small>{!! trans(date_format(date_create($image->created_at), 'l')) !!}
                        {{ (int) date_format(date_create($image->created_at), 'd') }}
                        {{ trans(date_format(date_create($image->created_at), 'F')) }}<small></h2>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif
