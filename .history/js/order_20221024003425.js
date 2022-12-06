document.getElementById('button').addEventListener('click', function() {
    document.querySelector('.bg-modal').style.visibility = 'visible';
});

document.querySelector('.close').addEventListener('click', function() {
    document.querySelector('.bg-modal').style.visibility = 'hidden';
});