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
        Schema::create('menuitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->string('title', 150)->nullable();
            $table->string('name', 150)->nullable();
            $table->string('slug', 200)->nullable();

            $table->string('type', 100);
            $table->boolean('target')->default(0);

            $table->integer('depth')->default(0);
            $table->integer('order_no')->default(0);

            $table->timestamps();

            $table->index('menu_id');
            $table->index('parent_id');
            $table->index('slug');
            $table->index(['menu_id', 'order_no']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menuitems');
    }
};
