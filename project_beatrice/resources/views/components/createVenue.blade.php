<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
        <h1 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                {{ trans('labels.newVenueTitle') }}
            </a>
        </h1>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <form id="venue-form" action="{{ route('venue.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" class="form-control"
                                placeholder="{{ trans('labels.name') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="city" class="form-control"
                                placeholder="{!! trans('labels.city') !!}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" class="form-control"
                                placeholder="{{ trans('labels.address') }}">
                        </div>
                        <div class="form-group">
                            <input type="url" name="maps" class="form-control"
                                placeholder="{{ trans('labels.mapsLink') }}">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <input type="submit" name="login-submit"
                                        class="form-control btn btn-primary"
                                        value="{{ trans('labels.confirm') }}">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>