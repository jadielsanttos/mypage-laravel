let scrollHorizontal = 0;

const sideBar = document.querySelector('.left_side_template');
const btnPrev = document.querySelector('.btn_prev');
const btnNext = document.querySelector('.btn_next');
const areaSlide = document.querySelector('.area_example_list');
const slideItems = document.querySelectorAll('.area_example_list .example_item');

window.addEventListener('resize', onResize);
btnPrev.addEventListener('click', prevSlide);
btnNext.addEventListener('click', nextSlide);

function prevSlide() {
    let x = scrollHorizontal + 440;

    if(x > 0) {
        x = 0;
    }

    areaSlide.style.marginLeft = `${x}px`;

    scrollHorizontal = x;
}

function nextSlide() {
    let slideWidth = slideItems.length
    let x = 0;

    if(scrollHorizontal !== 0) {
        x = scrollHorizontal - 440;
    }else {
        x = -440;
    }

    if(-((slideWidth * 220) - window.innerWidth) > x) {
        x = -((slideWidth * 220) - window.innerWidth) - 40;
    }

    areaSlide.style.marginLeft = `${x}px`;

    scrollHorizontal = x;
}

function onResize() {
    let slideWidth = slideItems.length
    let x = 0;

    if(-((slideWidth * 220) - window.innerWidth) > x) {
        x = -((slideWidth * 220) - window.innerWidth) - 40;
    }

    areaSlide.style.marginLeft = `${x}px`;

    scrollHorizontal = x;
}
