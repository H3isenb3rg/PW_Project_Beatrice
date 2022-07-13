<div class="row">
    <div class="col-sm-12">
        <h1>{{ trans('labels.jumbotronGalleryButton') }}</h1>
    </div>
</div>
@if ($isAdmin)
    <div class="row" style="margin-bottom: 2em;">
        <div class="col-sm-12">
            @include("components.gallery.form")
        </div>
    </div>
@endif
<div class="row">
    <div class="col-sm-12">
        @include("components.gallery.carousel", [
            "images" => $carousel
        ])
    </div>
</div>
