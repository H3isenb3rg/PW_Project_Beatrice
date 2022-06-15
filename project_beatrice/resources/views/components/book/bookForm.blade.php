<h2 style="margin-top: 0">{{ trans("Book Event") }}</h2>
<form class="form-horizontal" name="reservation" method="post" action="{{ route('reservation.store') }}">
    @csrf
    <div class="form-group">
        <div class="col-sm-8">
            <div class="input-group">
                <div class="input-group-addon">@include('icons.bookmark')</div>
                <input required class="form-control" type="text" id="name" name="name"
                    placeholder="{{ trans('Table Name') }}">
                <span class="help-block"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <div class="input-group">
                <div class="input-group-addon">@include('icons.people')</div>
                <input required type="number" min="1" max="100" step="1" name="guests" class="form-control"
                    placeholder="{{ trans('Guests Number') }}">
                <span class="help-block"></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8">
            <input type="hidden" name="event_id" value="{{ $event_id }}" />

            <div class="row">
                <div class="col-sm-5" style="padding-top: 1%">
                    <label for="mySubmit" class="btn btn-primary btn-large btn-block">@include('icons.confirmBook')
                        {{ trans('Book') }}</label>
                    <input id="mySubmit" type="submit" value='Save' class="hidden" />
                </div>
                <div class="col-sm-5" style="padding-top: 1%">
                    <a href="{{ route('home') }}" role="button"
                        class="btn btn-danger btn-large btn-block">@include('icons.close')</span>
                        {{ trans('Cancel') }}</a>
                </div>
            </div>
        </div>
    </div>
</form>
