$(".permis-menu-item").click(function () {
    $(".permis-liste").addClass("hidden");
    var div = $(this).children("a").attr('href');
    $(div).addClass('show');
    $(div).removeClass('hidden');
    $(".offre-title").text($(this).text());
});

$(".inscription-type").click(function () {
    $(".inscription-list").addClass("hidden");
    var element = $(this).find(".inscription-list")
    if (! element.hasClass("show")) {
        element.addClass('show');
        element.removeClass('hidden');
    } else {
        element.removeClass('show');
    }
})