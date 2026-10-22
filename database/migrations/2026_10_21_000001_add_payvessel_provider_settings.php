<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('general_settings', 'virtualcard_provider')) {
            Schema::table('general_settings', function (Blueprint $table) {
                $table->string('virtualcard_provider')->default('BLOCHQ');
            });
        }

        if (!Schema::hasColumn('general_settings', 'bills_provider')) {
            Schema::table('general_settings', function (Blueprint $table) {
                $table->string('bills_provider')->default('CURRENT');
            });
        }

        if (!Schema::hasColumn('virtual_cards', 'provider')) {
            Schema::table('virtual_cards', function (Blueprint $table) {
                $table->string('provider')->nullable();
            });
        }
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
