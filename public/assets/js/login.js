let input = document.querySelector('#pass');
let iconShowPassword = document.querySelector('.single_span');

iconShowPassword.addEventListener('click', showPassword);

function showPassword() {
    if(input.getAttribute('type') === 'text') {
        document.querySelector('.single_span i').style.color = '#ccc';
        input.setAttribute('type', 'password');
    }else {
        document.querySelector('.single_span i').style.color = '#000';
        input.setAttribute('type', 'text');
    }
}
