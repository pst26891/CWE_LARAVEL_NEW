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
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('article_id');
            $table->string('manuscript_no', 100);

            $table->unsignedInteger('download')->default(1);

            $table->string('ip', 45);
            $table->string('location')->nullable();

            $table->date('date');

            $table->unsignedBigInteger('update_by')->nullable();

            $table->timestamp('created_at')->useCurrent();

            $table->index(['article_id', 'date']);
            $table->index('manuscript_no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
