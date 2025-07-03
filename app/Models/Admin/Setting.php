<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = [
        'site_url', 'tagline', 'fevicon', 'site_title', 'call_us', 'head_email', 'logo', 'logo_small', 
        'mail_ath_reg', 'mail_rev_reg', 'mail_manu_submit', 'mail_send_resub', 'mail_choose_rev', 
        'mail_choose_ath', 'mail_reviesed', 'mail_manu_accept', 'mail_manu_reject', 'mail_manu_pub', 
        'foo_address', 'about_us', 'foo_phone', 'foo_mobile', 'foo_email', 'facebook', 'twitter', 
        'linkden', 'mendeley', 'rss', 'social_email', 'licence', 'con_facebook', 'trending1', 'trending2', 
        'trending3', 'con_twitter', 'con_person', 'con_address', 'about_journal', 'journal_pic', 
        'journal_metrics', 'journal_epub', 'journal_ppub', 'journal_short_name', 'journal_name', 
        'publisher', 'con_email', 'con_phone', 'con_designation', 'ath_secret_key', 'ath_site_key', 
        'rev_secret_key', 'rev_site_key', 'ath_response', 'copyright_form_doc', 'author_guide', 
        'manuscript_guide', 'template'
    ];
}
