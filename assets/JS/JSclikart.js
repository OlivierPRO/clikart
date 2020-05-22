/*modal bootstrap*/
$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').trigger('focus')
})

/*infos bulles*/
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

/*alertes bootstrap*/
$('.alert').alert()

/*script pour le visualisateur d'images fancybox*/
$('[data-fancybox="gallery"]').fancybox({
    // Options will go here
});

buttons: [
    "zoom",
    "slideShow",
    "fullScreen",
    "thumbs",
    "close"
]



