$(enableDebugFacebox)

function enableDebugFacebox() {
    $('#debug_exception').hide();
    $('a[rel*=facebox]').facebox({
        loadingImage : baseUrl + '/facebox/loading.gif',
        closeImage   : baseUrl + '/facebox/closelabel.gif'
    });
}
