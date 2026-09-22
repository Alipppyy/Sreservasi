@extends('layout.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Dashboard Admin</h2>
        <span class="badge bg-primary text-white p-2">Login as: {{ auth()->user()->name }}</span>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title fw-bold mb-4">Daftar Reservasi Servis</h4>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No. Booking</th>
                            <th>Customer</th>
                            <th>Unit/Keluhan</th>
                            <th>Status/Waktu</th>
                            <th>Teknisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr>
                            <td><span class="badge bg-secondary">{{ $booking->booking_number }}</span></td>
                            <td>
                                <strong>{{ $booking->customer_name }}</strong><br>
                                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $booking->customer_whatsapp) }}" target="_blank" class="text-decoration-none shadow-sm">
                                    <i class="bi bi-whatsapp text-success"></i> {{ $booking->customer_whatsapp }}
                                </a><br>
                                <small class="text-muted">{{ Str::limit($booking->customer_address, 30) }}</small>
                            </td>
                            <td>
                                <strong>{{ $booking->device_type }}</strong><br>
                                <small class="text-muted">{{ Str::limit($booking->complaint, 30) }}</small>
                            </td>
                            <td>
                                @if($booking->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($booking->status == 'assigned' || $booking->status == 'on_progress')
                                    <span class="badge bg-info">On Progress</span>
                                @elseif($booking->status == 'unpaid')
                                    <span class="badge bg-danger">Menunggu Pembayaran</span>
                                @elseif($booking->status == 'paid')
                                    <span class="badge bg-success">Lunas</span>
                                @endif
                                <br><small class="text-muted">{{ $booking->created_at->format('d M Y, H:i') }}</small>
                            </td>
                            <td>
                                @if($booking->technician)
                                    <span class="badge bg-light text-dark border"><i class="bi bi-person-fill"></i> {{ $booking->technician->name }}</span>
                                @else
                                    <span class="text-muted fst-italic">Belum ada</span>
                                @endif
                            </td>
                            <td>
                                @if($booking->status == 'pending')
                                    <form action="{{ route('admin.booking.assign', $booking->id) }}" method="POST" class="d-flex gap-2">
                                        @csrf
                                        <select name="technician_id" class="form-select form-select-sm" required>
                                            <option value="">-- Pilih Teknisi --</option>
                                            @foreach($technicians as $tech)
                                                <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-primary shadow-sm">Assign</button>
                                    </form>
                                @else
                                    <button class="btn btn-sm btn-secondary" disabled>Assigned</button>
                                    @if($booking->qris_url)
                                        <a href="{{ $booking->qris_url }}" target="_blank" class="btn btn-sm btn-outline-info"><i class="bi bi-qr-code"></i> Lihat QRIS</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada reservasi masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
