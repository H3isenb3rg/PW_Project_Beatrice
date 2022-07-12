<div class="row">
    <div class="col-sm-12">
        <h1>{{ trans('labels.jumbotronGalleryButton') }}</h1>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        @include("components.gallery.carousel", [
            "images" => $carousel
        ])
    </div>
</div>
