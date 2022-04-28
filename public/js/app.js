const menu = $("#banner-menu");
$(menu).on("click", function () {
    $("#banner-menu-content").toggle();
});
const filters = $("#banner-menu2");
$(filters).on("click", function () {
    $("#banner-menu-content2").toggle();
});



// ================================================

$(function () {
    var slideCount = $(".slider ol li").length;
    var slideWidth = $(".slider ol li").width();
    var slideHeight = $(".slider ol li").height();
    var slideUlWidth = slideCount * slideWidth;

    $(".slider").css({ "max-width": slideWidth, height: slideHeight });
    $(".slider ol").css({ width: slideUlWidth, "margin-left": -slideWidth });
    $(".slider ol li:last-child").prependTo($(".slider ol"));

    if (slideCount == 1) {
        $('ol').css('margin-left', 0);
    }

    function moveLeft() {
        $(".slider ol")
            .stop()
            .animate(
                {
                    left: +slideWidth,
                },
                700,
                function () {
                    $(".slider ol li:last-child").prependTo($(".slider ol"));
                    $(".slider ol").css("left", "");
                }
            );
    }

    function moveRight() {
        $(".slider ol")
            .stop()
            .animate(
                {
                    left: -slideWidth,
                },
                700,
                function () {
                    $(".slider ol li:first-child").appendTo($(".slider ol"));
                    $(".slider ol").css("left", "");
                }
            );
    }

    $(".next").on("click", function () {
        moveRight();
    });

    $(".prev").on("click", function () {
        moveLeft();
    });
});
