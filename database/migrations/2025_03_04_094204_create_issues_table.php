<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('alias', 300);
            $table->string('name', 300);
            $table->integer('volume_id')->default(0);
            $table->string('edition', 300)->nullable();
            $table->string('pages', 300)->nullable();
            $table->integer('special')->nullable();
            $table->longText('issue_topic')->nullable();
            $table->string('cover', 300)->nullable();
            $table->tinyInteger('status')->comment('1:active,0:Inactive');
            $table->longText('ebook')->nullable();
            $table->integer('coming')->default(0)->comment('0:no,1:yes');
            $table->integer('current')->default(0)->comment('0:no,1:yes');
            $table->timestamps();
            $table->integer('created_by')->nullable();

            // Indexes
            $table->index('alias');
            $table->index('volume_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('issues');
    }
};
