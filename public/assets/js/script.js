let menu =  document.querySelector('.left_side_template');
let areaTotal = document.querySelector('.container_single');
let btnCloseSideBar = document.querySelector('.btn_close_sidebar');
let iconHambuger = document.querySelector('.icon_menu');
let imgProfileUser = document.querySelector('.profile_img img');

window.onload = function() {
    verifyWidthScreen();

    window.addEventListener('resize', () => {
        if(window.innerWidth <= 600) {
            menu.style.display = 'none';
            areaTotal.style.marginLeft = '0';
        }
    })
}

// events
iconHambuger.addEventListener('click', () => {
    if(window.innerWidth <= 600) {
        openSideBarMobile();
    }else {
        toggleSideBar();
    }
});
imgProfileUser.addEventListener('click', toggleModalProfileUser);
btnCloseSideBar.addEventListener('click', closeSideBar);

// functions
function toggleSideBar() {
    if(menu.style.display === 'none') {
        menu.style.display = 'block';
        areaTotal.style.marginLeft = '230px';
    }else {
        menu.style.display = 'none';
        areaTotal.style.marginLeft = '0';
    }
}

function openSideBarMobile() {
    menu.style.display = 'block';
    areaTotal.style.marginLeft = '0';
}

function closeSideBar() {
    menu.style.display = 'none';
    areaTotal.style.marginLeft = '0';
}

function toggleModalProfileUser() {
    let modal = document.querySelector('.profile_popup');

    if(modal.style.display === 'block') {
        modal.style.display = 'none';
    }else {
        modal.style.display = 'block';
        setTimeout(() => {
            document.addEventListener('click', closeModalProfile);
        }, 200);
    }
}

function closeModalProfile() {
    document.querySelector('.profile_popup').style.display = 'none';
    document.removeEventListener('click', closeModalProfile);
}

function verifyWidthScreen() {
    if(window.innerWidth <= 768) {
        menu.style.display = 'none';
        areaTotal.style.marginLeft = '0';
    }
}
