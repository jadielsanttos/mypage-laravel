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

// function open modal profile-img
document.querySelector('.btn_open_modal').addEventListener('click', () => {
    document.querySelector('.modal_upload_img').style.opacity = '0';
    document.querySelector('.shadow_modal').style.opacity = '0';
    document.querySelector('.modal_upload_img').style.display = 'block';
    document.querySelector('.shadow_modal').style.display = 'block';

    setTimeout(() => {
        document.querySelector('.modal_upload_img').style.opacity = '1';
        document.querySelector('.shadow_modal').style.opacity = '1';
    }, 200);

});

// function close modal profile-img
document.querySelector('.close_modal').addEventListener('click', () => {
    document.querySelector('.modal_upload_img').style.opacity = '1';
    document.querySelector('.shadow_modal').style.opacity = '1';

    setTimeout(() => {
        document.querySelector('.modal_upload_img').style.display = 'none';
        document.querySelector('.shadow_modal').style.display = 'none';
    }, 200);

});


