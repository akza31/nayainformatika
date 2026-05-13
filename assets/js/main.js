const menuToggle = document.querySelector('.menu-toggle');
const mainNav = document.querySelector('.main-nav');

if (menuToggle && mainNav) {
    menuToggle.addEventListener('click', () => {
        const isOpen = mainNav.classList.toggle('open');
        menuToggle.setAttribute('aria-expanded', String(isOpen));
    });
}

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.16 });

document.querySelectorAll('.reveal').forEach((element) => observer.observe(element));

const serviceDetails = {
    company: 'Paket website profil mencakup struktur halaman, tampilan responsif, optimasi dasar, dan konten awal yang bisa disesuaikan dengan identitas perusahaan.',
    webapp: 'Aplikasi web dibuat untuk membantu pekerjaan administrasi, input data, laporan, dan dashboard internal dengan alur yang disesuaikan.',
    network: 'Layanan jaringan meliputi penataan perangkat, konfigurasi akses internet, segmentasi dasar, dokumentasi, dan pengecekan stabilitas.',
    consulting: 'Konsultasi IT membantu menentukan kebutuhan perangkat, software, prioritas pengembangan, serta rencana digitalisasi bertahap.'
};

const modal = document.querySelector('#service-modal');
const modalTitle = document.querySelector('#modal-title');
const modalCopy = document.querySelector('#modal-copy');
const modalClose = document.querySelector('.modal-close');

document.querySelectorAll('.detail-btn').forEach((button) => {
    button.addEventListener('click', () => {
        if (!modal || !modalTitle || !modalCopy) return;

        const key = button.dataset.detail;
        const cardTitle = button.closest('.service-card')?.querySelector('h2')?.textContent ?? 'Detail Layanan';

        modalTitle.textContent = cardTitle;
        modalCopy.textContent = serviceDetails[key] ?? 'Detail layanan belum tersedia.';
        modal.classList.add('open');
        modal.setAttribute('aria-hidden', 'false');
    });
});

function closeModal() {
    if (!modal) return;
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
}

modalClose?.addEventListener('click', closeModal);
modal?.addEventListener('click', (event) => {
    if (event.target === modal) {
        closeModal();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeModal();
    }
});

const contactForm = document.querySelector('#contact-form');
const formNote = document.querySelector('#form-note');

contactForm?.addEventListener('submit', (event) => {
    event.preventDefault();

    const submitButton = contactForm.querySelector('button[type="submit"]');
    const formData = new FormData(contactForm);

    if (formNote) {
        formNote.textContent = 'Mengirim pesan...';
        formNote.classList.remove('error');
    }

    if (submitButton) {
        submitButton.disabled = true;
        submitButton.textContent = 'Mengirim...';
    }

    fetch(contactForm.action, {
        method: 'POST',
        body: formData,
        headers: {
            Accept: 'application/json'
        }
    })
        .then((response) => response.json().then((data) => ({ ok: response.ok, data })))
        .then(({ ok, data }) => {
            if (!ok || !data.success) {
                throw new Error(data.message || 'Pesan belum bisa dikirim.');
            }

            contactForm.reset();
            if (formNote) {
                formNote.textContent = data.message;
            }
        })
        .catch((error) => {
            if (formNote) {
                formNote.textContent = error.message;
                formNote.classList.add('error');
            }
        })
        .finally(() => {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = 'Kirim Pesan';
            }
        });
});
