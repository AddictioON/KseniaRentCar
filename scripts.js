document.addEventListener('DOMContentLoaded', function() {

    const mainContents = document.querySelectorAll('.main-content');
    mainContents.forEach(mc => {
        mc.classList.remove('hidden-before-load');
        mc.classList.add('fade-in');
    });

    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', () => {
        });
    });

    const forms = document.querySelectorAll('.animate-form');
    forms.forEach(form => {
        form.addEventListener('submit', () => {
            const btn = form.querySelector('.btn-animate');
            if (btn) {
                btn.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    btn.style.transform = 'scale(1)';
                }, 200);
            }
        });
    });

    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.classList.add('focused');
        });
        input.addEventListener('blur', () => {
            input.classList.remove('focused');
        });
    });
});
