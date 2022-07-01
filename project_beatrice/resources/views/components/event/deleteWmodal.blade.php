<!-- Button trigger modal -->
<a type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" style="min-width: 15em;">
    @include("icons.calendarX") {{ trans("Delete Event") }}
</a>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{{ __("Confirm Delete") }}</h4>
            </div>
            <div class="modal-body">
                <dl class="dl-horizontal">
                    <dt>{{ __("labels.name") }}</dt><dd>{{ $event->name }}</dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ __("Cancel") }}</button>
                <button type="button" class="btn btn-danger">{{ __("Delete Event") }}</button>
            </div>
        </div>
    </div>
</div>
