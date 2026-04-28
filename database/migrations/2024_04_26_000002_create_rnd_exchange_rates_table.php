<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rnd_exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->decimal('rate', 20, 8)->default(204);
            $table->text('notes')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rnd_exchange_rates');
    }
};
