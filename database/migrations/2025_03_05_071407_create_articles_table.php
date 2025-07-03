<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('manuscript_no', 100)->unique();
            $table->integer('order_no');
            $table->foreignId('post_id')->nullable()->constrained('posts')->nullOnDelete();
            $table->string('title', 300);
            $table->longText('description')->nullable();
            $table->longText('url');
            $table->foreignId('article_type_id')->constrained('article_types')->cascadeOnDelete();
            $table->string('doi', 300)->nullable();
            $table->integer('volume');
            $table->integer('number');
            $table->longText('abstract');
            $table->longText('keyword');
            $table->longText('article_citation')->nullable();
            $table->longText('url_citation')->nullable();
            $table->longText('mla')->nullable();
            $table->longText('apa')->nullable();
            $table->longText('ama')->nullable();
            $table->longText('chicago')->nullable();
            $table->string('page_no', 100)->nullable();
            $table->string('upload_pdf', 300)->nullable();;
            $table->string('pdf_locate', 300);
            $table->string('recieved', 200)->nullable();
            $table->string('accepted', 200)->nullable();
            $table->string('pub_date_o', 200)->nullable();
            $table->string('pub_date_p', 200)->nullable();
            $table->string('plagrism_check_date', 300)->nullable();
            $table->string('first_reviewer', 300)->nullable();
            $table->string('first_rev_email', 300)->nullable();
            $table->string('first_rev_orcid_id', 300)->nullable();
            $table->string('first_rev_publons', 300)->nullable();
            $table->string('second_reviewer', 300)->nullable();
            $table->string('sec_rev_email', 300)->nullable();
            $table->string('sec_rev_orcid_id', 300)->nullable();
            $table->string('sec_rev_publons', 300)->nullable();
            $table->string('final_approval_date', 300)->nullable();
            $table->string('final_approval_by', 300)->nullable();
            $table->string('final_link', 300)->nullable();
            $table->string('pdf_download_link', 300)->nullable();
            $table->string('pdf_link', 300)->nullable();
            $table->integer('download')->default(0)->nullable();;
            $table->integer('view')->default(0)->nullable();;
            $table->string('meta_title', 300);
            $table->string('meta_keyword', 300)->nullable();
            $table->string('meta_description', 300)->nullable();
            $table->string('publisher_name', 300)->nullable();
            $table->string('category', 255);
            $table->string('composing', 300)->nullable();
            $table->string('proofread', 300)->nullable();
            $table->longText('authors')->nullable();
            $table->string('date', 300);
            $table->string('article_status', 300)->nullable();
            $table->boolean('status')->default(1);
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['volume', 'number', 'article_type_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
