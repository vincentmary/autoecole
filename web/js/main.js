$(".permis-menu-item").click(function() {
   $(".permis-liste").addClass("hidden");
   var div = $(this).children("a").attr('href');
   $(div).addClass('show');
   $(div).removeClass('hidden');
   $(".offre-title").text($(this).text());
});