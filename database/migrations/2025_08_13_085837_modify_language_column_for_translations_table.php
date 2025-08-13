<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->dropColumn('language');
            $table->unsignedBigInteger('language_id')->after('product_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });

        DB::table('languages')->insert([
            ['code' => 'EN', 'name' => 'Engels'],
            ['code' => 'NL', 'name' => 'Nederlands'],
            ['code' => 'FR', 'name' => 'Frans'],
            ['code' => 'DE', 'name' => 'Duits'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('translations', function (Blueprint $table) {
            $table->dropForeign(['language_id']);
            $table->dropColumn('language_id');
            $table->string('language')->after('product_id');
        });
    }
};
