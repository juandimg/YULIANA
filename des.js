const ads = document.querySelectorAll('.ad-des .ad');
let currentAdindex = 0; //Seleccionamos los anuncios

function showAd() {
    ads[currentAdindex].classList.remove('active');
    currentAdindex = (currentAdindex + 1) % ads.length;
    ads[currentAdindex].classList.add('active');
}

setInterval(showAd, 3000);

//  <!-- jQuery -->



$(document).ready(function(){
    $('.carrusel').slick({
        dots: false, // Oculta los puntos de navegación
        arrows: true, // Muestra flechas de navegación
        infinite: true, // Infinito
        speed: 300, // Velocidad de transición
        slidesToShow: 3, // Número de imágenes visibles
        slidesToScroll: 1, // Número de imágenes a desplazar
        autoplay: true, // Autoplay
        autoplaySpeed: 2000, // Velocidad del autoplay
        responsive: [
            {
                breakpoint: 768, // Ajustes para pantallas pequeñas
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480, // Ajustes para pantallas muy pequeñas
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});


