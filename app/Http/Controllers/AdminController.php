<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('technician')->orderBy('created_at', 'desc')->get();
        $technicians = User::where('role', 'teknisi')->get();

        return view('admin.dashboard', compact('bookings', 'technicians'));
    }

    public function assign(Request $request, $id)
    {
        $request->validate([
            'technician_id' => 'required|exists:users,id'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->technician_id = $request->technician_id;
        $booking->status = 'assigned';
        $booking->save();

        return redirect()->back()->with('success', 'Teknisi berhasil ditugaskan');
    }
}
