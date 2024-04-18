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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->nullable()
            ->constrained()
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->string('demo' ,1024)-> nullable();
            $table->string('picture', 1024)-> nullable();
            $table->string('bio', 1024)-> nullable();
            $table->string('cellphone',24)-> nullable();
            $table->string('members',1024)-> nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_details', function (Blueprint $table) {
            if (Schema::hasColumn('user_details', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });

        Schema::dropIfExists('user_details');
        
    }
};
