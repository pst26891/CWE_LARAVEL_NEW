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
        Schema::create('cmslinks', function (Blueprint $table) {
            $table->id('link_id');

            $table->unsignedBigInteger('parent')->default(0);
            $table->integer('cat')->default(0);

            $table->string('url');
            $table->string('dlink')->nullable();

            $table->integer('ord')->default(0);

            $table->string('image')->nullable();

            $table->string('heading');
            $table->longText('content')->nullable();

            $table->boolean('status')->default(1);
            $table->integer('position')->default(0);

            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();

            $table->string('page_type')->nullable();
            $table->string('template')->nullable();

            $table->timestamps();

            $table->index('parent');
            $table->index('cat');
            $table->index(['status', 'position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cmslinks');
    }
};
