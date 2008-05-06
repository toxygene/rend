$(onLoad);

function onLoad() {
    $('#debug p').click(function() {
        $('#debug .exception').slideToggle();
    });
}