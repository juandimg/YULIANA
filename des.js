const ads = document.querySelectorAll('.ad-des .ad');
let currentAdindex = 0; //Seleccionamos los anuncios

function showAd() {
    ads[currentAdindex].classList.remove('active');
    currentAdindex = (currentAdindex + 1) % ads.length;
    ads[currentAdindex].classList.add('active');
}

setInterval(showAd, 3000);