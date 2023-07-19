// function toggle sidebar
document.querySelector('.icon_menu').addEventListener('click', () => {
    let menu =  document.querySelector('.left_side_template');
    let areaTotal = document.querySelector('.container_single');

    if(menu.style.display === 'none') {
        menu.style.display = 'block';
        areaTotal.style.marginLeft = '230px';
    }else {
        menu.style.display = 'none';
        areaTotal.style.marginLeft = '0';
    }
});

// function toggle modal profile user
document.querySelector('.profile_img img').addEventListener('click', () => {
    let modal = document.querySelector('.profile_popup');

    if(modal.style.display === 'block') {
        modal.style.display = 'none';
    }else {
        modal.style.display = 'block';
        setTimeout(() => {
            document.addEventListener('click', closeModalProfile);
        }, 200);
    }
});

function closeModalProfile() {
    document.querySelector('.profile_popup').style.display = 'none';
    document.removeEventListener('click', closeModalProfile);
}

// function open modal profile img page
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

// function close modal profile img page
document.querySelector('.close_modal').addEventListener('click', () => {
    document.querySelector('.modal_upload_img').style.opacity = '1';
    document.querySelector('.shadow_modal').style.opacity = '1';

    setTimeout(() => {
        document.querySelector('.modal_upload_img').style.display = 'none';
        document.querySelector('.shadow_modal').style.display = 'none';
    }, 200);

});
