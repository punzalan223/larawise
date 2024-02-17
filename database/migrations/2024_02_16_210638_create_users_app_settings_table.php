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
        Schema::create('users_app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('dark_mode')->nullable();
            $table->string('topbar_bg')->nullable();
            $table->string('sidebar_bg')->nullable();
            $table->string('sidebar_logo_img')->nullable();
            $table->string('sidebar_title_name')->nullable();
            $table->string('footer_company_name')->nullable();
            $table->integer('created_by')->length(10)->unsigned()->nullable();
            $table->integer('updated_by')->length(10)->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_app_settings');
    }
};
