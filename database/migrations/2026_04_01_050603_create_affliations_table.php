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
        Schema::create('affliations', function (Blueprint $table) {
            $table->id();
            $table->string('article_id', 100);
            $table->string('manuscript_no', 100);
            $table->string('author_no', 50);

            $table->string('full_name', 255)->nullable();
            $table->string('department', 150)->nullable();
            $table->string('inst_name', 200)->nullable();
            $table->string('inst_address', 255)->nullable();
            $table->string('inst_city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('pincode', 10)->nullable();

            $table->string('mobile', 20)->nullable();
            $table->string('inst_tel', 20)->nullable();
            $table->string('fax', 20)->nullable();

            $table->timestamps();

            $table->index('article_id');
            $table->index('manuscript_no');
            $table->index('author_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affliations');
    }
};
