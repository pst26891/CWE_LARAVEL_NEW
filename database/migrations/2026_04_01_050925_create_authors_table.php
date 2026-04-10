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
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->string('manuscript_no', 100);
            $table->integer('order_no')->default(1);

            $table->string('title', 20)->nullable();
            $table->string('f_name', 100);
            $table->string('m_name', 100)->nullable();
            $table->string('l_name', 100)->nullable();

            $table->text('affiliation');
            $table->string('email', 150);
            $table->string('orcid_id', 50)->nullable();

            $table->boolean('correspond_author')->default(0);
            $table->boolean('status')->default(1);

            $table->timestamps();

            $table->index('article_id');
            $table->index('manuscript_no');
            $table->index('order_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
