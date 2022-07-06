<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    @foreach ($reservationsList as $reservation)
        @include('components.reservation.well', ['reservation' => $reservation])
    @endforeach
</div>
