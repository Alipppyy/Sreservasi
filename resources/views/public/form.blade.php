@extends('layout.app')

@section('title', 'Form Reservasi Servis')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4">
                <div class="card-body">
                    <h2 class="fw-bold mb-4 text-center">Form Reservasi Servis</h2>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('booking.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="customer_name" class="form-control" required placeholder="Contoh: Budi Santoso">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nomor WhatsApp</label>
                            <input type="text" name="customer_whatsapp" class="form-control" required placeholder="Contoh: 081234567890">
                            <div class="form-text">Pastikan nomor aktif untuk menerima notifikasi.</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alamat Lengkap</label>
                            <textarea name="customer_address" class="form-control" rows="3" required placeholder="Alamat rumah atau lokasi barang"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Unit Elektronik</label>
                            <select name="device_type" class="form-select" required>
                                <option value="" disabled selected>Pilih Jenis Unit</option>
                                <option value="AC">AC</option>
                                <option value="Kulkas">Kulkas</option>
                                <option value="Mesin Cuci">Mesin Cuci</option>
                                <option value="Televisi">Televisi</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Keluhan</label>
                            <textarea name="complaint" class="form-control" rows="4" required placeholder="Jelaskan kendala atau kerusakan yang dialami"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 btn-lg shadow-sm">
                            <i class="bi bi-send-fill me-2"></i>Kirim Reservasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
