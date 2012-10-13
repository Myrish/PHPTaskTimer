$(document).ready(function() {
    setInterval("refresh()", 1000);
});

$("a.ajax").live("click", function (event) {
    event.preventDefault();
    $.get(this.href);
});

function refresh() {
    $.get("?do=refresh");
}
