<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'latest_web_session_id')) {
                $table->string('latest_web_session_id', 191)->nullable()->index();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'latest_web_session_id')) {
                $table->dropColumn('latest_web_session_id');
            }
        });
    }
};
