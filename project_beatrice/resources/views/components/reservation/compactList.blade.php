<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    @foreach ($reservationsList as $reservation)
        @include('components.reservation.compactWell', ['reservation' => $reservation])
    @endforeach
</div>
