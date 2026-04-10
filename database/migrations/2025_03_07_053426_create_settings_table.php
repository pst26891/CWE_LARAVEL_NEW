<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->tinyInteger('id')->primary()->default(1);

            $table->string('site_url');
            $table->string('site_title', 150);
            $table->text('tagline')->nullable();

            $table->string('fevicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_small')->nullable();

            $table->string('call_us', 20)->nullable();
            $table->string('head_email', 150)->nullable();

            $table->text('foo_address')->nullable();
            $table->string('foo_phone', 20)->nullable();
            $table->string('foo_mobile', 20)->nullable();
            $table->string('foo_email', 150)->nullable();

            $table->longText('about_us')->nullable();
            $table->longText('about_journal')->nullable();

            $table->string('journal_name')->nullable();
            $table->string('journal_short_name')->nullable();

            $table->string('publisher')->nullable();

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();

            $table->longText('licence')->nullable();

            $table->longText('mail_ath_reg')->nullable();

            $table->string('template')->nullable();

            $table->boolean('deleted')->default(0);

            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
