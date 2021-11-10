(function($) {
  'use strict';
  $(function() {
    $('[data-toggle="offcanvas"]').on("click", function() {
      $('.sidebar-offcanvas').toggleClass('active')
      $("html").addClass("overflow-hidden")
      $('body').append(
        $('<div>').prop({
          className: "side-backdrop open in"
        })
      )
    });
    
    $('#closeSide').on("click", function() {
      $('.sidebar-offcanvas').removeClass('active')
      $('html').removeClass('overflow-hidden')
      $('div').remove('.side-backdrop');
    })
  });
})(jQuery);