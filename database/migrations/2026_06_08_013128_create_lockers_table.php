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
        Schema::create('lockers', function (Blueprint $table) {
            $table->id();
            $table->string('locker_code', 5);
            $table->string('locker_name', 60);
            $table->text('locker_description')->nullable();
            $table->enum('major', ['Web Programming', 'Multimedia', 'Teknik Jaringan']);
            $table->enum('locker_status', ['Available', 'Unavailable', 'Damaged', 'Missing'])->default('Available');
            $table->enum('batch', ['1', '2', '3'])->default('2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lockers');
    }
};
