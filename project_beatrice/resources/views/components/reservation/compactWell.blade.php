<div class="well panel" style="padding-top: 0; padding-bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-xs-5">
                <h3>
                    @include('icons.user') {{ $reservation->name }}
                </h3>
            </div>
            <div class="col-sm-3 col-xs-2">
                <h3>
                    @include('icons.people') {{ $reservation->guests }}
                </h3>
            </div>
            <div class="col-sm-2 col-xs-2">
                @include('components.reservation.editWmodal', ['reservation' => $reservation])
            </div>
            <div class="col-sm-2 col-xs-2">
                @include('components.reservation.deleteWmodal', ['reservation' => $reservation])
            </div>
            <div class="col-sm-1 col-xs-1">
                <h3>
                    <a type="button" title="{{ __('Add to Calendar') }}"
                        onclick='create_download_ics(
                        "{{ $reservation->event->name }}", 
                        "{{ $reservation->name }} - {{ $reservation->guests }}", 
                        "{{ $reservation->event->venue->name }}", 
                        "{{ $reservation->event->event_date }}", 
                        "{{ $reservation->event->event_date }}"
                        )'>
                        @include('icons.newEvent')
                    </a>
                </h3>
            </div>
        </div>
    </div>
</div>
