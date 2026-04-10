<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            $table->integer('order_no')->default(0);
            $table->unsignedBigInteger('post_id')->nullable();

            $table->string('meta_title', 255);
            $table->string('meta_keyword', 255)->nullable();
            $table->string('meta_description', 255)->nullable();

            $table->string('category', 150)->nullable();

            $table->integer('volume');
            $table->integer('number');
            $table->integer('article_type_id');

            $table->longText('abstract');
            $table->text('keyword');
            $table->text('authors')->nullable();

            $table->string('manuscript_no', 100);
            $table->text('title');
            $table->longText('description')->nullable();

            $table->date('date');

            $table->string('url', 255);

            $table->unsignedInteger('view')->default(0);
            $table->unsignedInteger('download')->default(0);

            $table->string('doi', 150)->nullable();

            $table->text('article_citation')->nullable();
            $table->text('url_citation')->nullable();
            $table->text('mla')->nullable();
            $table->text('apa')->nullable();
            $table->text('ama')->nullable();
            $table->text('chicago')->nullable();

            $table->string('page_no', 50)->nullable();

            $table->string('pdf_link')->nullable();
            $table->string('pdf_download_link')->nullable();

            $table->date('recieved')->nullable();
            $table->date('accepted')->nullable();
            $table->date('pub_date_o')->nullable();
            $table->date('pub_date_p')->nullable();
            $table->date('plagrism_check_date')->nullable();

            $table->string('first_reviewer', 150)->nullable();
            $table->string('second_reviewer', 150)->nullable();

            $table->string('first_rev_email', 150)->nullable();
            $table->string('sec_rev_email', 150)->nullable();

            $table->string('first_rev_orcid_id', 50)->nullable();
            $table->string('sec_rev_orcid_id', 50)->nullable();

            $table->string('first_rev_publons', 150)->nullable();
            $table->string('sec_rev_publons', 150)->nullable();

            $table->date('final_approval_date')->nullable();
            $table->string('final_approval_by', 150)->nullable();

            $table->string('final_link')->nullable();

            $table->string('upload_pdf');
            $table->string('pdf_locate');

            $table->string('article_status', 100)->nullable();

            $table->string('publisher_name', 150)->nullable();
            $table->string('composing', 150)->nullable();
            $table->string('proofread', 150)->nullable();

            $table->boolean('status')->default(1);

            $table->unsignedInteger('total_view')->default(0);
            $table->unsignedInteger('total_download')->default(0);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('manuscript_no');
            $table->index('volume');
            $table->index('number');
            $table->index('article_type_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
