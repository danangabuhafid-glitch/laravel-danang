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
        Schema::table('lockers', function (Blueprint $table) {
            $table->foreignId('key_id')->nullable()->after('locker_description')->constrained('keys')->onDelete('set null');
            $table->string('major')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lockers', function (Blueprint $table) {
            $table->dropForeign(['key_id']);
            $table->dropColumn('key_id');
            $table->enum('major', ['Web Programming', 'Multimedia', 'Teknik Jaringan'])->change();
        });
    }
};
