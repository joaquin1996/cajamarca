// menu desplegable
$(".menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    $("#nav").toggleClass("left");
    $(".content").toggleClass("left");
});