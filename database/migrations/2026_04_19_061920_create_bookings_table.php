<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->string('customer_name');
            $table->string('customer_whatsapp');
            $table->text('customer_address');
            $table->string('device_type');
            $table->text('complaint');
            $table->enum('status', ['pending','assigned','on_progress','done','unpaid','paid','cancelled'])->default('pending');
            $table->foreignId('technician_id')->nullable()->constrained('users')->nullOnDelete();
            $table->text('repair_description')->nullable();
            $table->decimal('total_cost', 15, 2)->nullable();
            $table->string('xendit_invoice_id')->nullable();
            $table->string('qris_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
