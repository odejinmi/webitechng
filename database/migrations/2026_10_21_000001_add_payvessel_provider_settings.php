<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->string('virtualcard_provider')->default('BLOCHQ');
            $table->string('bills_provider')->default('CURRENT');
        });

        Schema::table('virtual_cards', function (Blueprint $table) {
            $table->string('provider')->nullable();
        });
    }

    public function down()
    {
        Schema::table('virtual_cards', function (Blueprint $table) {
            $table->dropColumn('provider');
        });

        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn(['virtualcard_provider', 'bills_provider']);
        });
    }
};
