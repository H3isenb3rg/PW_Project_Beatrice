<form id="image-form" name="image-form" action="{{ route('gallery.upload') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-1 col-xs-2">
            <label for="uploadImage" class="btn btn-primary btn-block">
                @include('icons.upload')
            </label>
            <input id="uploadImage" type="submit" value="{{ trans('labels.confirm') }}" class="hidden" onclick="event.preventDefault(); checkImgUpload('{{ $lang }}')"/>
        </div>
        <div class="col-sm-9 col-xs-9">
            <div class="form-group">
                <div class="input-group">
                    <label id="img-label" class="form-label btn btn-default" for="img">@include('icons.image') - No file</label>
                    <input class="hidden" id='img' type='file' name="img" onchange='getImg(event)'/>
                    <script>
                        var imageIcon = "@include('icons.image')";
                        var noFileInnerHtml = imageIcon + " - {{ __('Upload an Image') }}";
                        $("#img-label").html(noFileInnerHtml);
                        
                        function getImg(evt){
                            var files = evt.target.files;
                            var file = files[0];
                            $("#img-label").html(imageIcon + " - " + file.name);
                        };
                    </script>
                </div>
            </div>
        </div>
    </div>
</form>
