// menu desplegable
$(".menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    $("#nav").toggleClass("left");
    $(".content").toggleClass("left");
});

// Testimonials carousel (uses the Owl Carousel library)
$(".testimonials-carousel").owlCarousel({
    autoplay: false,
    dots: false,
    loop: true,    
    responsive: {
      0: {
        items: 3
      },
      768: {
        items: 4
      },
      900: {
        items: 6
      }
    },
    nav: true,
    navText : ["<i class='ion ion-ios-arrow-back'></i>","<i class='ion ion-ios-arrow-forward'></i>"],
  });

  