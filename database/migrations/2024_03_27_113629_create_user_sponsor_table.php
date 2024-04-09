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
        // $hoursToAdd = 24;
        // $deadline = now()->addHours($hoursToAdd);
        Schema::create('user_sponsor', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->unsignedBigInteger('sponsor_id');
            $table->foreign('sponsor_id')
                ->references('id')
                ->on('sponsors')
                ->onUpdate('cascade')
                ->onDelete('cascade');


            $table->timestamps();
            $table->timestamp('expired_at')->nullable();
            // $table->primary(['user_id', 'sponsor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sponsor');
    }
};
