<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('user_missions', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('status');
            $table->string('status')->default('locked')->change();
        });
    }

    public function down()
    {
        Schema::table('user_missions', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};