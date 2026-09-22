@extends('layout.app')

@section('title', 'ElectroFix - Solusi Servis Elektronik Ahli')

@push('styles')
<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(22, 28, 45, 0.7), rgba(22, 28, 45, 0.8)), url('https://images.unsplash.com/photo-1581092160562-40aa08e78837?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
        min-height: 90vh;
        display: flex;
        align-items: center;
        color: white;
        padding-top: 80px; /* offset for transparent navbar */
        position: relative;
    }
    .hero-content {
        max-width: 600px;
    }
    .hero-title {
        font-size: 3.5rem;
        line-height: 1.1;
        margin-bottom: 1.25rem;
    }

    /* Stats Bar */
    .stats-bar {
        background: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); /* Soft shadow */
    }
    .stat-number {
        font-size: 2.5rem;
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1;
        margin-bottom: 0.2rem;
    }
    .stat-text {
        font-size: 0.9rem;
        color: var(--text-muted);
        max-width: 150px;
        line-height: 1.4;
    }

    /* Services Section */
    .service-card {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #eaeaea;
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
        background: white;
    }
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
    }
    .service-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .service-footer {
        padding: 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #f0f0f0;
    }
    .service-title {
        font-weight: 600;
        font-size: 1.05rem;
        margin-bottom: 0;
    }

    /* Why Choose Us Section */
    .why-us-section {
        background-color: var(--bg-light);
        padding: 80px 0;
    }
    .video-img-wrapper {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .video-img-wrapper img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    .play-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 70px;
        height: 70px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0dcf97; /* play button green */
        font-size: 1.5rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        padding-left: 5px;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .play-btn:hover {
        transform: translate(-50%, -50%) scale(1.1);
    }

    .feature-item {
        display: flex;
        align-items: flex-start;
        gap: 1.25rem;
        margin-bottom: 2rem;
    }
    .feature-icon-wrapper {
        width: 48px;
        height: 48px;
        background: #e9e7fa; /* light purple */
        color: var(--primary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .feature-content h5 {
        font-size: 1.15rem;
        margin-bottom: 0.4rem;
    }
    .feature-content p {
        color: var(--text-muted);
        font-size: 0.95rem;
        margin-bottom: 0;
    }

    /* Banner New */
    .banner-new {
        background-color: var(--primary-color);
        color: white;
        padding: 15px 0;
        text-align: center;
    }

    /* Testimonials Section */
    .testimonial-logo {
        height: 25px;
        opacity: 0.5;
        margin-bottom: 1.5rem;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .testimonial-text {
        font-size: 1.25rem;
        font-weight: 600;
        line-height: 1.6;
        margin-bottom: 2rem;
        text-align: center;
    }
    .testimonial-author {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }
    .testimonial-author img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    /* Contact/Booking Section */
    .contact-section {
        background-color: #2b2e35;
        background-image: repeating-linear-gradient(
            45deg,
            rgba(0,0,0,0.03) 0px,
            rgba(0,0,0,0.03) 100px,
            transparent 100px,
            transparent 200px
        );
        padding: 100px 0;
        color: white;
    }
    .icon-chat {
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #0dcf97; /* accent green */
        margin-bottom: 1.5rem;
    }
    /* Updated white card spacing */
    .booking-card {
        background: white;
        border-radius: 16px;
        padding: 2.5rem 2rem;
        box-shadow: 0 25px 50px rgba(0,0,0,0.1);
        color: var(--text-dark);
    }
    .form-control-custom {
        display: block;
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        font-weight: 400;
        line-height: 1.5;
        color: var(--text-dark);
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #e2e8f0;
        appearance: none;
        border-radius: 8px;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .form-control-custom:focus {
        border-color: var(--primary-color);
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(71, 59, 240, 0.25);
    }
    .form-label-custom {
        font-weight: 600;
        font-size: 0.85rem;
        margin-bottom: 0.4rem;
        display: block;
    }

    @media (max-width: 991px) {
        .hero-title { font-size: 2.5rem; }
        .stat-number { font-size: 2rem; }
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <!-- Bottom line colored element in design -->
    <div style="position:absolute; bottom:0; left:0; right:0; height:4px; background: #0ea5e9;"></div>

    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title">Serahkan pada konsultan ahli servis kami.</h1>
                <p class="lead mb-4 fw-light opacity-75">Dengan teknisi profesional dan pengalaman bertahun-tahun, kami memastikan barang elektronik Anda kembali berfungsi normal dalam hitungan menit.</p>
                <button onclick="document.getElementById('booking-section').scrollIntoView({behavior: 'smooth'})" class="btn btn-primary btn-lg shadow">Mulai Konsultasi <i class="bi bi-arrow-right ms-2"></i></button>
            </div>
        </div>
    </div>
</section>

<!-- Stats Bar -->
<section class="stats-bar border-bottom py-4">
    <div class="container py-2">
        <div class="row text-center g-4">
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <div class="me-3 stat-number">10K+</div>
                <div class="text-start stat-text">Pelanggan telah menggunakan jasa ElectroFix.</div>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center border-start border-end d-none d-md-flex text-center">
                <div class="me-3 stat-number">98%</div>
                <div class="text-start stat-text">Tingkat kepuasan dari seluruh pelanggan kami.</div>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center border-start d-md-none text-center">
                <div class="me-3 stat-number">98%</div>
                <div class="text-start stat-text">Tingkat kepuasan dari pelanggan kami.</div>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center">
                <div class="me-3 stat-number">4.9</div>
                <div class="text-start stat-text">Rata-rata ulasan pelayanan dari skala 5.00!</div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5 mt-5">
    <div class="container text-center mb-5">
        <h2 class="mb-3">Layanan yang kami tawarkan</h2>
        <p class="text-muted mx-auto" style="max-width: 500px;">Kami melayani perbaikan berbagai jenis elektronik rumah tangga. Pilih kategori layanan untuk melanjutkan dan memanggil teknisi ahli langsung ke lokasi Anda.</p>
    </div>

    <div class="container mb-5 pb-4">
        <div class="row g-4 justify-content-center">
            <!-- Card 1 -->
            <div class="col-sm-6 col-lg-3">
                <div class="service-card d-flex flex-column" onclick="selectService('AC')" style="cursor: pointer;">
                    <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&w=400&q=80" alt="Servis AC" class="service-img">
                    <div class="service-footer mt-auto">
                        <h5 class="service-title">Servis AC</h5>
                        <i class="bi bi-arrow-right fs-5 text-dark"></i>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-sm-6 col-lg-3">
                <div class="service-card d-flex flex-column" onclick="selectService('Kulkas')" style="cursor: pointer;">
                    <img src="https://images.unsplash.com/photo-1588854337236-6889d631faa8?auto=format&fit=crop&w=400&q=80" alt="Servis Kulkas" class="service-img">
                    <div class="service-footer mt-auto">
                        <h5 class="service-title">Reparasi Kulkas</h5>
                        <i class="bi bi-arrow-right fs-5 text-dark"></i>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-sm-6 col-lg-3">
                <div class="service-card d-flex flex-column" onclick="selectService('Mesin Cuci')" style="cursor: pointer;">
                    <img src="https://images.unsplash.com/photo-1626806787461-102c1bfaaea1?auto=format&fit=crop&w=400&q=80" alt="Servis Mesin Cuci" class="service-img">
                    <div class="service-footer mt-auto">
                        <h5 class="service-title">Mesin Cuci</h5>
                        <i class="bi bi-arrow-right fs-5 text-dark"></i>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-sm-6 col-lg-3">
                <div class="service-card d-flex flex-column" onclick="selectService('Televisi')" style="cursor: pointer;">
                    <img src="https://images.unsplash.com/photo-1593784991095-a205069470b6?auto=format&fit=crop&w=400&q=80" alt="Servis TV" class="service-img">
                    <div class="service-footer mt-auto">
                        <h5 class="service-title">Reparasi TV</h5>
                        <i class="bi bi-arrow-right fs-5 text-dark"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-us-section">
    <div class="container text-center mb-5">
        <h2 class="mb-3">Kenapa harus memilih kami?</h2>
        <p class="text-muted mx-auto" style="max-width: 500px;">Kami adalah solusi cepat dan tepat tanpa harus membawa barang berat Anda ke tempat servis. Teknisi datang, elektronik beres.</p>
    </div>

    <div class="container">
        <div class="row align-items-center g-5">
            <!-- Left: Video Image -->
            <div class="col-lg-6">
                <div class="video-img-wrapper">
                    <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&w=800&q=80" alt="Konsultasi Ahli">
                    <div class="play-btn">
                        <i class="bi bi-play-fill"></i>
                    </div>
                </div>
            </div>
            
            <!-- Right: Features List -->
            <div class="col-lg-6 ps-lg-5">
                <div class="feature-item">
                    <div class="feature-icon-wrapper">1</div>
                    <div class="feature-content">
                        <h5>Booking Mudah</h5>
                        <p>Cukup isi formulir singkat. Tidak perlu repot mendaftar atau membuat akun, informasi WA Anda menjadi referensi kami.</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon-wrapper">2</div>
                    <div class="feature-content">
                        <h5>Pendapat Teknisi Ahli</h5>
                        <p>Dapatkan penjelasan komprehensif mengenai kerusakan dari ahlinya langsung di lokasi sebelum penentuan biaya perbaikan.</p>
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon-wrapper">3</div>
                    <div class="feature-content">
                        <h5>Laporan Real-time</h5>
                        <p>Seluruh notifikasi progres dan metode pembayaran otomatis yang aman dikirim langsung ke perangkat WhatsApp Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Dynamic Banner Feature -->
<section class="banner-new">
    <div class="container">
        <span class="badge bg-white text-primary rounded-pill px-3 py-1 me-2 fw-bold" style="font-size: 0.75rem">BARU</span>
        <span class="fs-6 fw-medium text-white opacity-100">Kami sekarang mendukung penuh pembayaran via QRIS Instan tanpa biaya tambahan.</span>
    </div>
</section>

<!-- Testimonial Section -->
<section class="py-5 mt-5 mb-3">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4 text-center px-4">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" alt="Company Logo" class="testimonial-logo">
                <p class="testimonial-text">"Pelayanan servis AC sungguh luar biasa, praktis dan pembayarannya terintegrasi sepenuhnya."</p>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                    <div class="text-start">
                        <div class="fw-bold fs-6">Ilya Vasin</div>
                        <div class="text-muted small">Wiraswasta</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center px-4">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" alt="Company Logo" class="testimonial-logo">
                <p class="testimonial-text">"Sistem yang wajib dicoba untuk kebutuhan mendesak rumah tangga tangga. Teknisi handal!"</p>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User">
                    <div class="text-start">
                        <div class="fw-bold fs-6">Mariano Rasg</div>
                        <div class="text-muted small">Designer Grafis</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center px-4">
                <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" alt="Company Logo" class="testimonial-logo">
                <p class="testimonial-text">"Terbantu banget tidak perlu repot bawa TV ke bengkel jauh-jauh, reservasinya cepat beres."</p>
                <div class="testimonial-author">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                    <div class="text-start">
                        <div class="fw-bold fs-6">Oka Tomoaki</div>
                        <div class="text-muted small">Marketing Executive</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form / Booking Background Section -->
<section id="booking-section" class="contact-section position-relative">
    <div class="container">
        <div class="row align-items-center">
            
            <!-- Left Text Content -->
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="icon-chat">
                    <i class="bi bi-chat-dots-fill"></i>
                </div>
                <h2 class="display-5 fw-bold mb-4">Dapatkan konsultasi gratis dari teknisi ahli kami!</h2>
                <p class="lead opacity-75 fs-5">Isi formulir lengkap sesuai keluhan di samping. Kami akan langsung mengalokasikan teknisi spesifik untuk kunjungan dan pengecekan gratis!</p>
            </div>

            <!-- Right Offset Form -->
            <div class="col-lg-6 offset-lg-1">
                <div class="booking-card">
                    <h4 class="fw-bold mb-4 text-center" style="font-family:'Space Grotesk', sans-serif;">Panggil Teknisi</h4>
                    <form action="{{ route('booking.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label-custom">Nama Lengkap</label>
                            <input type="text" name="customer_name" class="form-control-custom" placeholder="contoh: Budi Santoso" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Telepon / WhatsApp</label>
                            <input type="tel" name="customer_whatsapp" class="form-control-custom" placeholder="contoh: 0812-3456-7890" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Layanan yang Dibutuhkan?</label>
                            <select name="device_type" id="formDeviceType" class="form-control-custom" required>
                                <option value="" disabled selected>Pilih Layanan Servis</option>
                                <option value="AC">Servis AC</option>
                                <option value="Kulkas">Reparasi Kulkas</option>
                                <option value="Mesin Cuci">Mesin Cuci</option>
                                <option value="Televisi">Televisi Bergaransi</option>
                                <option value="Lainnya">Elektronik Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Alamat Kunjungan</label>
                            <textarea name="customer_address" class="form-control-custom" rows="2" placeholder="Alamat rumah atau lokasi barang" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label-custom">Detail Keluhan</label>
                            <textarea name="complaint" class="form-control-custom" rows="2" placeholder="Jelaskan ringkas masalah yang dialami" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 mt-2 py-3">Jadwalkan Servis Rumah <i class="bi bi-chevron-right ms-1"></i></button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Autofill the dropdown based on clicking a service card
    function selectService(serviceValue) {
        document.getElementById('booking-section').scrollIntoView({behavior: 'smooth'});
        const selectElement = document.getElementById('formDeviceType');
        if(selectElement) {
            selectElement.value = serviceValue;
            
            // Highlight element to show to user it changed
            selectElement.style.borderColor = '#473bf0';
            selectElement.style.boxShadow = '0 0 0 0.25rem rgba(71, 59, 240, 0.25)';
            setTimeout(() => {
                selectElement.style.borderColor = '';
                selectElement.style.boxShadow = '';
            }, 1000);
        }
    }
</script>
@endpush
