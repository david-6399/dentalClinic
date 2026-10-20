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
        Schema::table('page_section_items', function (Blueprint $table) {
            $table->string('value', 40)->nullable()->after('description');
            $table->string('suffix', 20)->nullable()->after('value');
            $table->string('icon_color', 7)->nullable()->after('icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('page_section_items', function (Blueprint $table) {
            $table->dropColumn(['value', 'suffix', 'icon_color']);
        });

    }
};
