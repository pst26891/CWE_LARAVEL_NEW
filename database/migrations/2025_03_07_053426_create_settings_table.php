<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_url', 300);
            $table->text('tagline');
            $table->string('fevicon', 300);
            $table->string('site_title', 300);
            $table->string('call_us', 300);
            $table->string('head_email', 300);
            $table->string('logo', 300);
            $table->string('logo_small', 300);
            $table->text('mail_ath_reg');
            $table->text('mail_rev_reg');
            $table->text('mail_manu_submit');
            $table->text('mail_send_resub');
            $table->text('mail_choose_rev');
            $table->text('mail_choose_ath');
            $table->text('mail_reviesed');
            $table->text('mail_manu_accept');
            $table->text('mail_manu_reject');
            $table->text('mail_manu_pub');
            $table->text('foo_address');
            $table->text('about_us');
            $table->string('foo_phone', 300);
            $table->string('foo_mobile', 300);
            $table->string('foo_email', 300);
            $table->string('facebook', 300);
            $table->string('twitter', 300);
            $table->string('linkden', 300);
            $table->text('mendeley');
            $table->string('rss', 300);
            $table->string('social_email', 300);
            $table->text('licence');
            $table->string('con_facebook', 300);
            $table->string('trending1', 300);
            $table->string('trending2', 300);
            $table->string('trending3', 300);
            $table->string('con_twitter', 300);
            $table->string('con_person', 300);
            $table->text('con_address');
            $table->text('about_journal');
            $table->string('journal_pic', 300);
            $table->text('journal_metrics');
            $table->string('journal_epub', 300);
            $table->string('journal_ppub', 300);
            $table->string('journal_short_name', 300);
            $table->string('journal_name', 300);
            $table->string('publisher', 300);
            $table->string('con_email', 300);
            $table->string('con_phone', 300);
            $table->string('con_designation', 300);
            $table->string('ath_secret_key', 300);
            $table->string('ath_site_key', 300);
            $table->string('rev_secret_key', 300);
            $table->string('rev_site_key', 300);
            $table->string('ath_response', 300);
            $table->string('copyright_form_doc', 300);
            $table->string('author_guide', 300);
            $table->string('manuscript_guide', 300);
            $table->string('template', 300);
            $table->timestamp('updated_at')->nullable();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
