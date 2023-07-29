let scrollHorizontal = 0;

const btnPrev = document.querySelector('.btn_prev');
const btnNext = document.querySelector('.btn_next');
const areaSlide = document.querySelector('.area_example_list');
const slideItems = document.querySelectorAll('.area_example_list .example_item');

btnPrev.addEventListener('click', prevSlide);
btnNext.addEventListener('click', nextSlide);

function prevSlide() {
    let x = scrollHorizontal + 500;

    if(x > 0) {
        x = 0;
    }

    areaSlide.style.marginLeft = `${x}px`;

    scrollHorizontal = x;
}

function nextSlide() {
    let x = 0;

    if(scrollHorizontal !== 0) {
        x = scrollHorizontal - 500;
    }else {
        x = -500;
    }

    areaSlide.style.marginLeft = `${x}px`;

    scrollHorizontal = x;
}
