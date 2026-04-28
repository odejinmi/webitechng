<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rnd_token_purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('rnd_amount', 20, 8)->default(0);
            $table->decimal('exchange_rate', 20, 8)->default(0);
            $table->decimal('total_amount', 20, 8)->default(0);
            $table->string('vendor_name')->nullable();
            $table->text('vendor_payment_details')->nullable();
            $table->string('payment_proof')->nullable();
            $table->string('receipt')->nullable();
            $table->enum('status', ['processing', 'pending', 'approved', 'declined'])->default('processing');
            $table->text('admin_note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rnd_token_purchases');
    }
};
