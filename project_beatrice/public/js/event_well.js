function down_caret(span_id) {
    $(span_id).removeClass();
    $(span_id).addClass("bi bi-caret-down-fill");
}

function up_caret(span_id) {
    $(span_id).removeClass();
    $(span_id).addClass("bi bi-caret-up-fill");
}

$(document).ready(function() {
    $(".panel-collapse").each(function() {
        var collapsed_panel = this;
        
        $("#"+this.id).on('show.bs.collapse', (function(id) {
            return function() {up_caret(id)}
        })("#icon"+this.id))

        $("#"+this.id).on('hide.bs.collapse', (function(id) {
            return function() {down_caret(id)}
        })("#icon"+this.id))
    })
});