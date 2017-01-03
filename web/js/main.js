$(".permis-menu-item").click(function () {
    $(".permis-liste").addClass("hidden");
    var div = $(this).children("a").attr('href');
    $(div).addClass('show');
    $(div).removeClass('hidden');
    $(".offre-title").text($(this).text());
});

$(".inscription-type").click(function () {
    $(".inscription-list").addClass("hidden");
    var element = $(this).find(".inscription-list").addClass('show');
    $(this).find(".inscription-list").removeClass('hidden');
})