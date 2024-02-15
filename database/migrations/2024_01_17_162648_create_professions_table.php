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
        Schema::create('professions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_prof');
            $table->string('image');
            $table->string('description');
            $table->timestamps();
        });
        
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade')->onUpdate('cascade');
        });
    
    }

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropForeign('users_profession_id_foreign');
            $table->dropColumn('profession_id');
        });
        Schema::dropIfExists('professions');
    }
};
