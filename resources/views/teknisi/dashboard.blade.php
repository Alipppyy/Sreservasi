@extends('layout.app')

@section('title', 'Teknisi Dashboard')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Dashboard Teknisi</h2>
        <span class="badge bg-success text-white p-2">Login as: {{ auth()->user()->name }}</span>
    </div>

    <div class="row">
        @forelse($bookings as $booking)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                        <span class="badge bg-secondary fs-6">{{ $booking->booking_number }}</span>
                        @if($booking->status == 'assigned')
                            <span class="badge bg-info text-dark">Tugas Baru</span>
                        @elseif($booking->status == 'unpaid')
                            <span class="badge bg-warning text-dark"><i class="bi bi-clock-history"></i> Menunggu Pembayaran</span>
                        @elseif($booking->status == 'paid')
                            <span class="badge bg-success"><i class="bi bi-check-circle"></i> Lunas</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold">{{ $booking->customer_name }}</h5>
                        <p class="text-muted small mb-2"><i class="bi bi-geo-alt"></i> {{ $booking->customer_address }}</p>
                        <hr>
                        <p><strong>Device:</strong> {{ $booking->device_type }}<br>
                        <strong>Keluhan:</strong> {{ $booking->complaint }}</p>

                        @if($booking->status == 'assigned' || in_array($booking->status, ['on_progress']))
                            <!-- Form Penyelesaian -->
                            <form action="{{ route('teknisi.booking.complete', $booking->id) }}" method="POST" class="mt-3 p-3 bg-light rounded shadow-sm border">
                                @csrf
                                <h6 class="fw-bold text-primary mb-3"><i class="bi bi-tools"></i> Form Penyelesaian Servis</h6>
                                <div class="mb-2">
                                    <label class="form-label small fw-bold">Detail Perbaikan</label>
                                    <textarea name="repair_description" class="form-control form-control-sm" rows="2" required placeholder="Contoh: Penggantian freon dan kapasitor"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Total Biaya (Rp)</label>
                                    <input type="number" name="total_cost" class="form-control form-control-sm" required min="1000" placeholder="Contoh: 350000">
                                </div>
                                <button type="submit" class="btn btn-primary w-100 btn-sm shadow-sm">
                                    <i class="bi bi-qr-code"></i> Generate Tagihan QRIS & Selesai
                                </button>
                            </form>
                        @else
                            <div class="mt-3 p-3 bg-light rounded shadow-sm border">
                                <h6 class="fw-bold"><i class="bi bi-info-circle text-primary"></i> Detail Servis Selesai</h6>
                                <ul class="list-unstyled mb-0 small">
                                    <li><strong>Perbaikan:</strong> {{ $booking->repair_description }}</li>
                                    <li><strong>Total Biaya:</strong> Rp {{ number_format($booking->total_cost, 0, ',', '.') }}</li>
                                </ul>
                                @if($booking->qris_url)
                                    <a href="{{ $booking->qris_url }}" target="_blank" class="btn btn-outline-dark btn-sm mt-3 w-100">
                                        <i class="bi bi-qr-code-scan"></i> Buka Link Invoice QRIS
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">Belum ada tugas servis yang dialokasikan untuk Anda.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
