<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Services\WhatsAppService;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function showForm()
    {
        return view('public.form');
    }

    public function submit(Request $request, WhatsAppService $waService)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_whatsapp' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'device_type' => 'required|string',
            'complaint' => 'required|string',
        ]);

        $booking = Booking::create(array_merge($validated, [
            'booking_number' => 'BKG-' . strtoupper(Str::random(8)),
            'status' => 'pending'
        ]));

        // Notify customer
        $message = "Halo {$booking->customer_name}, reservasi perbaikan {$booking->device_type} Anda telah kami terima dengan nomor reservasi: {$booking->booking_number}. Kami akan segera menugaskan teknisi untuk Anda.";
        $waService->sendMessage($booking->customer_whatsapp, $message);

        return redirect('/')->with('success', "Reservasi berhasil dibuat! Nomor Booking Anda: {$booking->booking_number}");
    }
}
