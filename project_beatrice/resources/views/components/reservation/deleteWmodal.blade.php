<!-- Button trigger modal -->
<h3>
    <a title="{{ __('Delete Reservation') }}" style="color: red;" type="button" data-toggle="modal"
        data-target="#modalDelRes{{ $reservation->id }}">
        @include('icons.close')
    </a>
</h3>

<!-- Modal -->
<div class="modal fade" id="modalDelRes{{ $reservation->id }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ __('Delete Reservation') }}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-5">
                        <a class="btn btn-danger btn-block"
                            href="{{ route('reservation.delete', ['id' => $reservation->id]) }}">{{ __('Confirm Delete') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
