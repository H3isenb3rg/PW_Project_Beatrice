<div class="row">
    <div class="col-sm-12">
        <h1>{{ trans('labels.jumbotronGalleryButton') }}</h1>
    </div>
</div>
@if (isset($isAdmin) && $isAdmin)
    <div class="row" style="margin-bottom: 2em;">
        <div class="col-sm-12">
            @include('components.gallery.form')
        </div>
    </div>
@endif
<div class="row" style="margin-bottom: 2em">
    <div class="col-sm-12">
        @include('components.gallery.carousel', [
            'images' => $carousel,
        ])
    </div>
</div>
@if (isset($images))
    <div class="row">
        <div class="col-md-12">
            <div class="gal">
                @foreach ($images as $image)
                            <img class="img-responsive"
                                src="{{ url('/') }}/img/gallery/{{ $image->path }}" 
                                alt="{{ $image->path }}" 
                                title="{!! trans(date_format(date_create($image->created_at), 'l')) !!} {{ (int) date_format(date_create($image->created_at), 'd') }} {{ trans(date_format(date_create($image->created_at), 'F')) }}">
                @endforeach
            </div>
        </div>
    </div>
@endif
