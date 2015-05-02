$(document).ready(function () {
    $('.sticky').sticky();
});

jQuery.fn.sticky = function () {
    var element = $(this);
    if ( !! $(element).offset()) { // make sure ".sticky" element exists
        var stickyTop = $(element).offset().top; // returns number
        $(window).scroll(function () { // scroll event
            var windowTop = $(window).scrollTop(); // returns number
            if (windowTop > ($(document).height() - (450 + $(element).height()))) {
                var fix = ($(document).height() - (450 + $(element).height()));
                $(element).css({
                    position: 'absolute',
                    top: fix + 'px'
                });
            } else {
                if (stickyTop < windowTop) {
                    $(element).css({
                        position: 'fixed',
                        top: "20px",
                        left: $(element).offset().left + "px"
                    });
                } else {
                    $(element).css('position', 'static');
                }
            }
        });
    }
}
