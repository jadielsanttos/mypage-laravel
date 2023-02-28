document.querySelector('.icon_menu').addEventListener('click', toggleAside);

function toggleAside() {
    let aside =  document.querySelector('nav');
    let areaTotal = document.querySelector('.container_single');

    if(aside.style.display === 'none') {
        aside.style.display = 'flex';
        areaTotal.style.marginLeft = '80px';
    }else {
        aside.style.display = 'none';
        areaTotal.style.marginLeft = '0';
    }
}

