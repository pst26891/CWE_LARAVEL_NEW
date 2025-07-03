<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('volumes', function (Blueprint $table) {
            $table->id();
            $table->string('alias', 300);
            $table->string('name', 300);
            $table->tinyInteger('status')->comment('0:active,1:Inactive');
            $table->timestamps();
            $table->integer('created_by')->nullable();

            
        });
    }

    public function down()
    {
        Schema::dropIfExists('volumes');
    }
};
