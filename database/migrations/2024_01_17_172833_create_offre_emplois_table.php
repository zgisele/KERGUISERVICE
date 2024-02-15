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
        Schema::create('offre_emplois', function (Blueprint $table) {
            $table->id();
            $table->string('typeContrat');
            $table->string('lieu');
            $table->string('description');
            $table->string('experienceMinimum');
            $table->string('slaireMinimum');
            $table->string('image');
            $table->date('dateline');
            $table->enum('etat',['nouveau','invalide','archiver']);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('profession_id');
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('candidatures', function (Blueprint $table) {
            $table->foreign('offre_emploi_id')->references('id')->on('offre_emplois')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidatures', function (Blueprint $table)
        {
            $table->dropForeign('candidatures_offre_emploi_id_foreign');
            $table->dropColumn('offre_emploi_id');
        });
        Schema::dropIfExists('offre_emplois');
    }
};
