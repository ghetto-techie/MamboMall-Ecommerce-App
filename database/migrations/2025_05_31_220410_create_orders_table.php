<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Relationship
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Order info
            $table->decimal('grand_total', 10, 2)->nullable();
            $table->enum('payment_method', [
                'mpesa', 
                'card', 
                'cash_on_delivery'
            ])->default('cash_on_delivery');
            
            $table->enum('payment_status', [
                'pending', 
                'paid', 
                'failed', 
                'refunded'
            ])->default('pending');

            $table->enum('status', [
                'new', 
                'processing', 
                'shipped', 
                'delivered', 
                'cancelled'
            ])->default('new');

            $table->string('currency', 3)->default('KES');
            $table->decimal('shipping_amount', 10, 2)->nullable();

            $table->enum('shipping_method', [
                'pickup', 
                'motorbike',
                'courier', 
                'g4s', 
                'matatu_parcel'
            ])->default('pickup');

            $table->text('notes')->nullable();

            // Timestamps
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
