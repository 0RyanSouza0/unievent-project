const themeSwitch = document.getElementById('themeSwitch');
const body = document.body;

// Verifica se já tem um tema salvo
const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'dark') {
    body.classList.add('dark-mode');
    themeSwitch.checked = true;
}

// Atualiza o tema quando o switch é clicado
themeSwitch.addEventListener('change', function () {
    if (this.checked) {
        body.classList.add('dark-mode');
        localStorage.setItem('theme', 'dark');
    } else {
        body.classList.remove('dark-mode');
        localStorage.setItem('theme', 'light');
    }
});