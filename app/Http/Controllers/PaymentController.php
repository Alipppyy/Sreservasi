<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function webhook(Request $request, WhatsAppService $waService)
    {
        $externalId = $request->input('external_id');
        $status = $request->input('status'); // e.g. PAID, EXPIRED

        Log::info("Xendit Webhook Received", $request->all());

        if (!$externalId) {
            return response()->json(['status' => 'error', 'message' => 'no external_id'], 400);
        }

        $booking = Booking::where('booking_number', $externalId)->first();

        if ($booking) {
            if ($status === 'PAID') {
                $booking->status = 'paid';
                $booking->save();

                // Send Receipt
                $message = "Terima kasih {$booking->customer_name}.\n"
                    . "Pembayaran sebesar Rp " . number_format($booking->total_cost, 0, ',', '.') . " untuk reservasi {$booking->booking_number} telah LUNAS.\n"
                    . "Perbaikan elektronik Anda telah selesai dengan baik.";
                $waService->sendMessage($booking->customer_whatsapp, $message);
            } elseif ($status === 'EXPIRED') {
                // If expired, maybe we shouldn't fail the whole booking, just leave it unpaid.
                Log::info("Invoice for {$booking->booking_number} has EXPIRED.");
            }

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Booking not found'], 404);
    }
}
