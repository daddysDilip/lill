

;
(function ($) {

    var $headerClose = $('.header-close-icon'),
            $headerTop = $('.header-top');

    if ($headerTop.length > 0) {

        $headerClose.on('click', function () {

            $headerTop.slideUp(500);

        });
    }

})(jQuery);
;
(function ($) {
    var $accoridanTrigger = $('.pro-head'),
            $accoridanSection = $('.pro-section'),
            $accoridanSectionOpen = $('.pro-section.open'),
            $closeSpeed = 500,
            $openSpeed = 500;

    // create a span for arrow
    var $arrow = $("<span>", {
        class: "accoridan-arrow"
    });

    $accoridanTrigger.append($arrow);

    $accoridanSectionOpen.css({
        'display': 'block'
    });

    // Attach event handler
    $(document).on('click', '.pro-head', stichAccoridan);


    function stichAccoridan() {

        // Find current accoridan-section section
        var $currentSection = $(this).next('.pro-section');

        if ($(this).hasClass('open')) {

            $(this).removeClass('open').addClass('a-close');
            $currentSection.removeClass('open').addClass('a-close');
            $currentSection.slideUp($closeSpeed);

        } else if ($(this).hasClass('a-close')) {

            $accoridanSection.slideUp($closeSpeed);
            $accoridanTrigger.removeClass('open').addClass('a-close');
            $accoridanSection.removeClass('open').addClass('a-close');

            $(this).addClass('open').removeClass('a-close');
            $currentSection.addClass('open').removeClass('a-close');
            $currentSection.slideDown($closeSpeed);

        } else {

            // Add and Remove class
            $accoridanTrigger.removeClass('open').addClass('a-close');
            $accoridanSection.removeClass('open').addClass('a-close');

            $(this).addClass('open').removeClass('a-close');
            $currentSection.addClass('open').removeClass('a-close');
            // Close current open accoridian section
            $accoridanSection.slideUp($closeSpeed);

            // Open current accordian section 
            $currentSection.slideDown($openSpeed);

        }
    }
})(jQuery);


(function ($) {
    $.fn.extend({
        rotaterator: function (options) {

            var defaults = {
                fadeSpeed: 1000,
                pauseSpeed: 500,
                child: null
            };

            var options = $.extend(defaults, options);

            return this.each(function () {
                var o = options;
                var obj = $(this);
                var items = $(obj.children(), obj);
                items.each(function () { $(this).hide(); })
                if (!o.child) {
                    var next = $(obj).children(':first');
                } else {
                    var next = o.child;
                }
                $(next).fadeIn(o.fadeSpeed, function () {
                    $(next).delay(o.pauseSpeed).fadeOut(o.fadeSpeed, function () {
                        var next = $(this).next();
                        if (next.length == 0) {
                            next = $(obj).children(':first');
                        }
                        $(obj).rotaterator({ child: next, fadeSpeed: o.fadeSpeed, pauseSpeed: o.pauseSpeed });
                    })
                });
            });
        }
    });
})(jQuery);

$(document).ready(function () {
    $('#rotate').rotaterator({ fadeSpeed: 900, pauseSpeed: 300 });
});
