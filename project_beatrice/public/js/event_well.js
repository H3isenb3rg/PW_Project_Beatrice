function hidden_caret(span_id) {
    $(span_id).removeClass();
    $(span_id).addClass("bi bi-caret-down-fill");
}

function shown_caret(span_id) {
    $(span_id).removeClass();
    $(span_id).addClass("bi bi-caret-up-fill");
}

function hide_caret(span_id) {
    $(span_id).removeClass();
    $(span_id).addClass("bi bi-arrow-up-short");
}

function show_caret(span_id) {
    $(span_id).removeClass();
    $(span_id).addClass("bi bi-arrow-down-short");
}

$(document).ready(function() {
    $(".panel-collapse").each(function() {
        var collapsed_panel = this;
        
        $("#"+this.id).on('show.bs.collapse', (function(id) {
            return function() {show_caret(id)}
        })("#icon"+this.id))

        $("#"+this.id).on('hide.bs.collapse', (function(id) {
            return function() {hide_caret(id)}
        })("#icon"+this.id))
        
        $("#"+this.id).on('shown.bs.collapse', (function(id) {
            return function() {shown_caret(id)}
        })("#icon"+this.id))

        $("#"+this.id).on('hidden.bs.collapse', (function(id) {
            return function() {hidden_caret(id)}
        })("#icon"+this.id))
    })
});