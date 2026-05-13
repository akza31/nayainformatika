<section class="page-hero reveal">
    <span class="eyebrow">Kontak</span>
    <h1>Mari diskusikan kebutuhan digital perusahaan Anda.</h1>
    <p>Isi formulir singkat berikut. Pesan yang dikirim akan tersimpan ke database MariaDB.</p>
</section>

<section class="contact-layout">
    <form class="contact-form reveal" id="contact-form" action="save_contact.php" method="post">
        <label>
            Nama
            <input type="text" name="name" placeholder="Nama Anda" required>
        </label>
        <label>
            Email
            <input type="email" name="email" placeholder="nama@email.com" required>
        </label>
        <label>
            Kebutuhan
            <select name="service" required>
                <option value="">Pilih layanan</option>
                <option>Website Company Profile</option>
                <option>Aplikasi Web</option>
                <option>Jaringan & Infrastruktur</option>
                <option>Konsultasi IT</option>
            </select>
        </label>
        <label>
            Pesan
            <textarea name="message" rows="5" placeholder="Ceritakan kebutuhan Anda" required></textarea>
        </label>
        <button class="btn primary" type="submit">Kirim Pesan</button>
        <p class="form-note" id="form-note" aria-live="polite"></p>
    </form>

    <aside class="contact-info reveal">
        <h2>Informasi Perusahaan</h2>
        <p><strong>Alamat</strong><br>Jl. Teknologi No. 21, Jakarta</p>
        <p><strong>Email</strong><br>info@nayainformatika.co.id</p>
        <p><strong>Telepon</strong><br>+62 812 3456 7890</p>
        <p><strong>Jam Operasional</strong><br>Senin - Jumat, 08.00 - 17.00 WIB</p>
    </aside>
</section>
