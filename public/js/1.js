let buttonAlert = document.getElementById('buttonAlert');
let alert = document.getElementById('alert');

buttonAlert.addEventListener('click', closeAlert);

function closeAlert() {
    alert.classList.add('hidden');
}
