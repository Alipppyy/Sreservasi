<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Services\XenditService;
use App\Services\WhatsAppService;

class TechnicianController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('technician_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('teknisi.dashboard', compact('bookings'));
    }

    public function complete(Request $request, $id, XenditService $xenditService, WhatsAppService $waService)
    {
        $request->validate([
            'repair_description' => 'required|string',
            'total_cost' => 'required|numeric|min:1',
        ]);

        $booking = Booking::where('technician_id', auth()->id())->findOrFail($id);
        $booking->repair_description = $request->repair_description;
        $booking->total_cost = $request->total_cost;
        
        // Generate Xendit QRIS
        $invoice = $xenditService->createInvoice(
            $booking->booking_number,
            $booking->total_cost,
            'customer@example.com', // Optional
            'Pembayaran Servis - ' . $booking->booking_number
        );

        if ($invoice) {
            $booking->xendit_invoice_id = $invoice['id'];
            $booking->qris_url = $invoice['invoice_url'];
            $booking->status = 'unpaid';
            $booking->save();

            // Send WA Notification
            $message = "Halo {$booking->customer_name}, perbaikan unit {$booking->device_type} telah selesai.\n"
                . "Detail: {$booking->repair_description}\n"
                . "Total Biaya: Rp " . number_format($booking->total_cost, 0, ',', '.') . "\n"
                . "Silakan lakukan pembayaran melalui QRIS berikut: {$booking->qris_url}\n(Link berlaku 5 menit)";
            
            $waService->sendMessage($booking->customer_whatsapp, $message);

            return redirect()->back()->with('success', 'Pekerjaan selesai, tagihan QRIS telah dikirim ke pelanggan.');
        }

        return redirect()->back()->with('error', 'Gagal membuat tagihan QRIS. Silakan coba lagi.');
    }
}
