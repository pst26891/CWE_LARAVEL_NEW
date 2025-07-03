<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('issue_name', 255);
            $table->tinyInteger('status')->default(0)->comment('0: Active, 1: Inactive');
            $table->integer('sorder')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert Default Data
        DB::table('article_types')->insert([
            ['id' => 1, 'name' => 'Article', 'issue_name' => 'Research Articles', 'status' => 0, 'sorder' => 4],
            ['id' => 2, 'name' => 'Review Article', 'issue_name' => 'Review Articles', 'status' => 0, 'sorder' => 3],
            ['id' => 3, 'name' => 'Brief Communication', 'issue_name' => 'Brief Communication', 'status' => 1, 'sorder' => 0],
            ['id' => 4, 'name' => 'Editorial', 'issue_name' => 'Editorial', 'status' => 0, 'sorder' => 1],
            ['id' => 5, 'name' => 'Short Communication', 'issue_name' => 'Short Communication', 'status' => 0, 'sorder' => 5],
            ['id' => 6, 'name' => 'Case Study', 'issue_name' => 'Case Study', 'status' => 0, 'sorder' => 6],
            ['id' => 7, 'name' => 'Book Review', 'issue_name' => 'Book Review', 'status' => 0, 'sorder' => 7],
            ['id' => 8, 'name' => 'Editorial Contribution', 'issue_name' => 'Editorial Contribution', 'status' => 0, 'sorder' => 2],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_types');
    }
};
