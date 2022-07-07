<!-- Button trigger modal -->
<h3>
    <a type="button" data-toggle="modal" data-target="#modalRes{{ $reservation->id }}">
        @include('icons.edit')
    </a>
</h3>

<!-- Modal -->
<div class="modal fade" id="modalRes{{ $reservation->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ __('Edit reservation') }}</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="reservation" method="put"
                    action="{{ route('reservation.edit', ['reservation' => $reservation->id]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4 col-xs-4">
                            <div class="form-group" id="table_name_div" style="padding-left: 1em;">
                                <div class="input-group">
                                    <div class="input-group-addon">@include('icons.bookmark')</div>
                                    <input required class="form-control" type="text" id="table_name"
                                        name="table_name" placeholder="{{ trans('Table Name') }}"
                                        value="{{ $reservation->name }}">
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-sm-offset-1 col-xs-3 col-xs-offset-1">
                            <div class="form-group" id="guests_div">
                                <div class="input-group">
                                    <div class="input-group-addon">@include('icons.people')</div>
                                    <input required type="number" min="1" max="100" step="1"
                                        name="guests" id="guests" class="form-control"
                                        placeholder="{{ trans('Guests Number') }}"
                                        value="{{ $reservation->guests }}">
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-sm-offset-1 col-xs-3 col-xs-offset-1">
                            <input id="resID" type="hidden" name="resID"
                                value="{{ $reservation->id }}" />
                            <label for="mySubmit"
                                class="btn btn-primary btn-large btn-block">@include('icons.confirm')</label>
                            <input id="mySubmit" type="submit" value='Save' class="hidden"
                                onclick="event.preventDefault(); checkResEdit('{{ $lang }}')" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
