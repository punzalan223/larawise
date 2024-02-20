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
        Schema::create('module_generators', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('controller_name')->nullable();
            $table->string('controller_path')->nullable();
            $table->string('icon_img_path')->nullable();
            $table->string('route_name')->nullable();
            $table->string('blade_path')->nullable();
            $table->string('livewire_path')->nullable();
            $table->string('livewire_controller_path')->nullable();
            $table->string('is_active')->nullable();
            $table->string('privilege_access_id')->nullable();
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
        Schema::dropIfExists('module_generators');
    }
};


