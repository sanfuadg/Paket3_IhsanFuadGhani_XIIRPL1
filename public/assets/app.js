function bootFlashAutoHide() {
    document.querySelectorAll('[data-flash]').forEach((el) => {
        setTimeout(() => {
            el.style.transition = 'all .25s ease';
            el.style.opacity = '0';
            el.style.transform = 'translateY(4px)';
            setTimeout(() => el.remove(), 250);
        }, 2800);
    });
}

function bootFormValidation() {
    document.querySelectorAll('form[data-validate="simple"]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            const requiredFields = form.querySelectorAll('[data-required="true"]');
            let invalid = false;

            requiredFields.forEach((field) => {
                const value = typeof field.value === 'string' ? field.value.trim() : field.value;
                field.classList.remove('border-rose-400', 'ring-rose-100');
                if (!value) {
                    invalid = true;
                    field.classList.add('border-rose-400', 'ring-rose-100');
                }
            });

            if (invalid) {
                event.preventDefault();
                const alertBox = form.querySelector('[data-inline-alert]');
                if (alertBox) {
                    alertBox.classList.remove('hidden');
                    alertBox.textContent = 'Mohon lengkapi semua field yang wajib diisi.';
                }
            }
        });
    });
}

function bootLogoutConfirm() {
    document.querySelectorAll('[data-logout-form]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            if (!window.confirm('Yakin ingin keluar dari halaman admin?')) {
                event.preventDefault();
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    bootFlashAutoHide();
    bootFormValidation();
    bootLogoutConfirm();
});