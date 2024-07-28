jQuery(document).ready(function($) {
    $('[data-fancybox="gallery"]').fancybox({
        // Optional customizations
        loop: true,
        buttons: [
            "zoom",
            "slideShow",
            "thumbs",
            "close"
        ]
    });
});
