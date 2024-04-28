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
        Schema::create('big_data', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->string('image');
            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('email');
            $table->string('test5');
            $table->string('test6');
            $table->string('test7');
            $table->string('test8');
            $table->string('test9');
            $table->string('test10');
            $table->string('test11');
            $table->string('test12');
            $table->string('test13');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('big_data');
    }
};
