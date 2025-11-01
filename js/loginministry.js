document.getElementById('showRegister').addEventListener('click', function() {
    document.querySelector('.login-card').style.display = 'none';
    document.querySelector('.register-card').style.display = 'block';
});

document.getElementById('showLogin').addEventListener('click', function() {
    document.querySelector('.register-card').style.display = 'none';
    document.querySelector('.login-card').style.display = 'block';
});
