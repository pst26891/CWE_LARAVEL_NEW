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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->integer('parent')->default(0);
            $table->integer('cat')->default(0);
            $table->longText('url');
            $table->longText('dlink');
            $table->bigInteger('ord')->default(0);
            $table->string('image', 255);
            $table->longText('title')->charset('utf8')->collation('utf8_bin');
            $table->longText('description');
            $table->tinyInteger('status')->nullable();
            $table->integer('position')->nullable();
            $table->longText('meta_title');
            $table->longText('meta_keyword');
            $table->longText('meta_description');
            $table->string('page_type', 255)->nullable();
            $table->string('template', 300);
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
