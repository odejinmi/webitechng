<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('transactions')) {
            return;
        }

        Schema::table('transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('transactions', 'balance_before')) {
                $table->decimal('balance_before', 28, 8)->nullable()->after('amount');
            }

            if (!Schema::hasColumn('transactions', 'balance_after')) {
                $table->decimal('balance_after', 28, 8)->nullable()->after('balance_before');
            }
        });
    }

    public function down()
    {
        if (!Schema::hasTable('transactions')) {
            return;
        }

        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'balance_before')) {
                $table->dropColumn('balance_before');
            }

            if (Schema::hasColumn('transactions', 'balance_after')) {
                $table->dropColumn('balance_after');
            }
        });
    }
};
