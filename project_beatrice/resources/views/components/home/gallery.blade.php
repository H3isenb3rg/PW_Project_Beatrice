<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Arcangelo DJ</h1>
                        <p>{{ trans('labels.jumbotronGallery1') }}</p>
                        <p>{{ trans('labels.jumbotronGallery2') }}</p>
                        <p><a class="btn btn-primary btn-lg" href="{{ route('gallery.index') }}"
                                role="button">{{ trans('labels.jumbotronGalleryButton') }}</a></p>
                </div>
                <div class="col-sm-6" >
                    <img id="gallery-image" src="{{ url('/') }}/img/gallery/{{ $latest->path }}" class="img-rounded img-responsive"
                        alt="Il team Arcangelo DJ" title="Team ADJ" style="display: block; margin: auto;">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function resizeGalleryImage(item) {
        if ($(window).height() > $(window).width()) {
            $(item).height(0.3 * $(window).height())
        } else {
            $(item).height(0.6 * $(window).height())
        }
    }

    $(document).ready(function() {
        resizeGalleryImage($("#gallery-image"));

        $(window).resize(function() {
            resizeGalleryImage($("#gallery-image"));
        });
    });
</script>
