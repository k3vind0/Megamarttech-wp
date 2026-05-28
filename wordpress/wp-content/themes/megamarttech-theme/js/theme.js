// Theme Toggle Script
document.addEventListener('DOMContentLoaded', function() {
    // Obtener tema guardado o usar tema del sistema
    const savedTheme = localStorage.getItem('theme') || 'light';
    const htmlElement = document.documentElement;
    
    // Aplicar tema guardado
    htmlElement.setAttribute('data-bs-theme', savedTheme);
    updateThemeIcon(savedTheme);
    
    // Obtener botón de tema
    const themeToggle = document.querySelector('.theme-toggle');
    
    if (themeToggle) {
        themeToggle.addEventListener('click', toggleTheme);
    }
});

function toggleTheme() {
    const htmlElement = document.documentElement;
    const currentTheme = htmlElement.getAttribute('data-bs-theme') || 'light';
    const newTheme = currentTheme === 'light' ? 'dark' : 'light';
    
    // Cambiar tema
    htmlElement.setAttribute('data-bs-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    
    // Actualizar icono
    updateThemeIcon(newTheme);
}

function updateThemeIcon(theme) {
    const themeToggle = document.querySelector('.theme-toggle');
    if (themeToggle) {
        const icon = themeToggle.querySelector('i');
        if (theme === 'dark') {
            icon.classList.remove('bi-sun-fill');
            icon.classList.add('bi-moon-stars-fill');
        } else {
            icon.classList.remove('bi-moon-stars-fill');
            icon.classList.add('bi-sun-fill');
        }
    }
}
