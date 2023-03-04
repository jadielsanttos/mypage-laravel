// function toggle sidebar
document.querySelector('.icon_menu').addEventListener('click', () => {
    let aside =  document.querySelector('nav');
    let areaTotal = document.querySelector('.container_single');

    if(aside.style.display === 'none') {
        aside.style.display = 'flex';
        areaTotal.style.marginLeft = '80px';
    }else {
        aside.style.display = 'none';
        areaTotal.style.marginLeft = '0';
    }
});

// function toggle modal profile
document.querySelector('.area_icon_profile').addEventListener('click', () => {
    let modal = document.querySelector('.modal_options_to_user');

    if(modal.style.display === 'block') {
        modal.style.display = 'none';
    }else {
        modal.style.display = 'block';
    }
});


