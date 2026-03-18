<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'latest_api_token_id')) {
                $table->unsignedBigInteger('latest_api_token_id')->nullable()->index();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'latest_api_token_id')) {
                $table->dropColumn('latest_api_token_id');
            }
        });
    }
};
