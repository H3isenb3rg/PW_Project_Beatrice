<div class="row">
    <div class="col-sm-12">
        <h1>{{ trans('labels.next_reservations') }}</h1>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach ($reservationsList as $reservation)
                @include('components.reservation.well', ['reservation' => $reservation])
            @endforeach
        </div>
    </div>
</div>
