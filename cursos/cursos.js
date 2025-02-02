let currentcurso = 0;

const totalboxes = document.querySelectorAll('.box').length;
const carousel = document.querySelector('.carousel');

function moveRight(){
    if(currentcurso < totalboxes - 1){
        currentcurso++;
        updateCarousel();
    }
}

function moveLeft(){
    if(currentcurso > 0){
        currentcurso--;
        updateCarousel();
    }
}

function updateCarousel(){
    const offset = currentcurso * 20;
    carousel.style.transform = `translateX(-${offset}%)`;
}

function updateCarousel(){
    const offset = currentcurso * 20;
    carousel.style.transform = `translateX(+${offset}%)`;
}