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
        Schema::table('ws_user', function (Blueprint $table) {
            $table->foreign('ws_country_id')->references('ws_country_id')->on('ws_country')->onDelete('cascade');
            $table->foreign('ms_user_created_by')->references('ws_user_id')->on('ws_user')->onDelete('cascade');
            $table->foreign('ms_user_updated_by')->references('ws_user_id')->on('ws_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ws_user', function (Blueprint $table) {
            //
        });
    }
};
