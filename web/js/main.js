$(".permis-menu-item").click(function() {
   $(".permis-menu-item").each(function() {
     $(this).removeClass('active');
   });
   $(".permis-liste").addClass("hidden");
   var div = $(this).children("a").attr('href');
   $(div).addClass('show');
   $(div).removeClass('hidden');
});