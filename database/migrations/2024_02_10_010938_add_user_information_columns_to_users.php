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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('contact')->nullable()->after('last_name');
            $table->string('status')->nullable()->after('contact');
            $table->string('privilege_id')->nullable()->after('status');
            $table->string('img')->nullable()->after('privilege_id');
            $table->string('dark_mode')->nullable()->after('img');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('contact');
            $table->dropColumn('status');
            $table->dropColumn('privilege_id');
            $table->dropColumn('img');
            $table->dropColumn('dark_mode');
        });
    }
};
