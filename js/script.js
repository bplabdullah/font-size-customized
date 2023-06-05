jQuery(document).ready(function($) {
    $('.increase-font-size').on('click', function() {
        var currentFontSize = parseInt($('.font-size-content').css('font-size'));
        var newFontSize = currentFontSize + 2;
        $('.font-size-content').css('font-size', newFontSize + 'px');
    });

    $('.decrease-font-size').on('click', function() {
        var currentFontSize = parseInt($('.font-size-content').css('font-size'));
        if (currentFontSize > 2) {
            var newFontSize = currentFontSize - 2;
            $('.font-size-content').css('font-size', newFontSize + 'px');
        }
    });
});
