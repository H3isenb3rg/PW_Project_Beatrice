<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        @for ($i = 1; $i < count($images); $i++)
            <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
        @endfor
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        @include('components.gallery.carouselImg', ['is_active' => 'active', 'image' => $images[0]])
        @for ($i = 1; $i < count($images); $i++)
            @include('components.gallery.carouselImg', ['is_active' => '', 'image' => $images[$i]])
        @endfor
    </div>
</div>
