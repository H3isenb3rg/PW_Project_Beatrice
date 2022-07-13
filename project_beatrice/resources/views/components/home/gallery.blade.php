<div class="row">
    <div class="col-sm-12">
        <div class="jumbotron">
            <div class="row display-flex">
                <div class="col-sm-6 col-xs-12" id="gallery-text">
                    <div>
                        <h2>Arcangelo DJ</h2>
                        <p>{{ trans('labels.jumbotronGallery1') }}</p>
                        <p>{{ trans('labels.jumbotronGallery2') }}</p>
                        <p><a class="btn btn-primary btn-lg" href="{{ route('gallery.index') }}"
                                role="button">{{ trans('labels.jumbotronGalleryButton') }}</a></p>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12" id="gallery-image">
                    <img src="{{ url('/') }}/img/gallery/{{ $latest->path }}"
                        class="img-rounded img-responsive center-block" alt="Il team Arcangelo DJ" title="Team ADJ">
                </div>
            </div>
        </div>
    </div>
</div>