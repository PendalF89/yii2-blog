$(document).ready(function() {
    $(".duplicate-input").on("keyup change", function() {
        $(".duplicate-output").val($(this).val());
    });
});