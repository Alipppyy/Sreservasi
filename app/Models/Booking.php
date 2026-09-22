<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number',
        'customer_name',
        'customer_whatsapp',
        'customer_address',
        'device_type',
        'complaint',
        'status',
        'technician_id',
        'repair_description',
        'total_cost',
        'xendit_invoice_id',
        'qris_url'
    ];

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
}
