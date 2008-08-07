$(enableDebugFacebox)

function enableDebugFacebox() {
    $('#debug_complete').hide()
                        .before('<a href="#debug_complete" rel="facebox">(Click here to show/hide the exception)</a>');
    $('a[rel*=facebox]').facebox();
}
