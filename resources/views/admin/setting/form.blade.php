<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#general">General</a></li>
    <li><a data-toggle="tab" href="#footer">Footer</a></li>

    <li><a data-toggle="tab" href="#contact">Contact</a></li>
    <li><a data-toggle="tab" href="#emails">Emails</a></li>
    <li><a data-toggle="tab" href="#journal">Journal</a></li>

    <li><a data-toggle="tab" href="#guidelines">Guidelines</a></li>

    <li><a data-toggle="tab" href="#security">Security</a></li>

</ul>
<div class="tab-content">
    <div id="general" class="tab-pane fade show active">

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Site URL <span class="red">*</span></label>
            <div class="col-sm-10">
                <input type="text" name="site_url" class="form-control" placeholder="Site URL" value="{{ old('site_url', $setting->site_url ?? '') }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Site Title <span class="red">*</span></label>
            <div class="col-sm-10">
                <input type="text" name="site_title" class="form-control" placeholder="Site Title" value="{{ old('site_title', $setting->site_title ?? '') }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tagline</label>
            <div class="col-sm-10">
                <textarea name="tagline" class="form-control" rows="3" placeholder="Tagline">{{ old('tagline', $setting->tagline ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">About us</label>
            <div class="col-sm-10">
                <textarea name="about_us" class="form-control" rows="3" placeholder="About Us">{{ old('about_us', $setting->about_us ?? '') }}</textarea>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Logo</label>

            @if(isset($setting->logo) && !empty($setting->logo))

            <div class="col-lg-5">
                <input type="file" id="logo" name="logo" class="form-control-file">

            </div>
            <div class="col-lg-2">
                <img src="{{url('uploads').'/'.$setting->logo}}" alt="Logo" title="Logo" />
            </div>
            @else
            <div class="col-lg-5">
                <input type="file" id="logo" name="logo" class="form-control-file">
            </div>
            @endif
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Small Logo</label>
            @if(isset($setting->logo_small) && !empty($setting->logo_small))

            <div class="col-lg-5">
                <input type="file" id="logo_small" name="logo_small" class="form-control-file">

            </div>
            <div class="col-lg-2">
                <img src="{{url('uploads').'/'.$setting->logo_small}}" alt="logo_small" title="logo_small" />
            </div>
            @else
            <div class="col-lg-5">
                <input type="file" id="logo_small" name="logo_small" class="form-control-file">
            </div>
            @endif

        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Favicon</label>
            @if(isset($setting->fevicon) && !empty($setting->fevicon))

            <div class="col-lg-5">
                <input type="file" id="fevicon" name="fevicon" class="form-control-file">

            </div>
            <div class="col-lg-2">
                <img src="{{url('uploads').'/'.$setting->fevicon}}" alt="fevicon" title="fevicon" />
            </div>
            @else
            <div class="col-lg-5">
                <input type="file" id="fevicon" name="fevicon" class="form-control-file">
            </div>
            @endif

        </div>
    </div>
    <div class="tab-pane fade" id="footer" role="tabpanel">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Footer Phone</label>
            <div class="col-sm-10">
                <input type="text" name="foo_phone" class="form-control" placeholder="Phone" value="{{ old('foo_phone', $setting->foo_phone ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Footer Mobile</label>
            <div class="col-sm-10">
                <input type="text" name="foo_mobile" class="form-control" placeholder="Mobile" value="{{ old('foo_mobile', $setting->foo_mobile ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Footer Email</label>
            <div class="col-sm-10">
                <input type="email" name="foo_email" class="form-control" placeholder="Email" value="{{ old('foo_email', $setting->foo_email ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Footer Address</label>
            <div class="col-sm-10">
                <textarea name="foo_address" id="foo_address" class="form-control">{{ old('foo_address', $setting->foo_address ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">licence</label>
            <div class="col-sm-10">
                <input type="text" name="licence" class="form-control" placeholder="licence" value="{{ old('licence', $setting->licence ?? '') }}">
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="contact" role="tabpanel">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Call Us</label>
            <div class="col-sm-10">
                <input type="text" name="call_us" class="form-control" placeholder="Contact Number" value="{{ old('call_us', $setting->call_us ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Head Email</label>
            <div class="col-sm-10">
                <input type="email" name="head_email" class="form-control" placeholder="Email" value="{{ old('head_email', $setting->head_email ?? '') }}">
            </div>
        </div>



        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Contact Phone</label>
            <div class="col-sm-10">
                <input type="text" name="con_phone" class="form-control" placeholder="Contact Phone" value="{{ old('con_phone', $setting->con_phone ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Contact Email</label>
            <div class="col-sm-10">
                <input type="email" name="con_email" class="form-control" placeholder="Contact Email" value="{{ old('con_email', $setting->con_email ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Address</label>
            <div class="col-sm-10">
                <textarea name="con_address" class="form-control" placeholder="Address" rows="3">{{ old('con_address', $setting->con_address ?? '') }}</textarea>
            </div>
        </div>

        {{-- Social Links --}}
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Facebook</label>
            <div class="col-sm-10">
                <input type="text" name="facebook" class="form-control" placeholder="Facebook URL" value="{{ old('facebook', $setting->facebook ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Twitter</label>
            <div class="col-sm-10">
                <input type="text" name="twitter" class="form-control" placeholder="Twitter URL" value="{{ old('twitter', $setting->twitter ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">LinkedIn</label>
            <div class="col-sm-10">
                <input type="text" name="linkden" class="form-control" placeholder="LinkedIn URL" value="{{ old('linkden', $setting->linkden ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mendeley</label>
            <div class="col-sm-10">
                <input type="text" name="mendeley" class="form-control" placeholder="mendeley" value="{{ old('mendeley', $setting->mendeley ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Rss</label>
            <div class="col-sm-10">
                <input type="text" name="rss" class="form-control" placeholder="rss" value="{{ old('rss', $setting->rss ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Contact Facebook</label>
            <div class="col-sm-10">
                <input type="text" name="con_facebook" class="form-control" placeholder="Facebook URL" value="{{ old('con_facebook', $setting->con_facebook ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Contact Twitter</label>
            <div class="col-sm-10">
                <input type="text" name="con_twitter" class="form-control" placeholder="Twitter URL" value="{{ old('con_twitter', $setting->con_twitter ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Social Email</label>
            <div class="col-sm-10">
                <input type="email" name="social_email" class="form-control" placeholder="Social Email" value="{{ old('social_email', $setting->social_email ?? '') }}">
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="emails" role="tabpanel">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mail - Author Registration</label>
            <div class="col-sm-10">

                <textarea name="mail_ath_reg" id="mail_ath_reg" class="form-control ckeditor" rows="4">{{ old('mail_ath_reg', $setting->mail_ath_reg ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mail - Reviewer Registration</label>
            <div class="col-sm-10">
                <textarea name="mail_rev_reg" id="mail_rev_reg" class="form-control ckeditor" rows="4">{{ old('mail_rev_reg', $setting->mail_rev_reg ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mail - Manuscript Submission</label>
            <div class="col-sm-10">
                <textarea name="mail_manu_submit" id="mail_manu_submit" class="form-control ckeditor" rows="4">{{ old('mail_manu_submit', $setting->mail_manu_submit ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mail - Send Resubmission</label>
            <div class="col-sm-10">
                <textarea name="mail_send_resub" id="mail_send_resub" class="form-control ckeditor" rows="4">{{ old('mail_send_resub', $setting->mail_send_resub ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mail - Choose Reviewer</label>
            <div class="col-sm-10">
                <textarea name="mail_choose_rev" id="mail_choose_rev" class="form-control ckeditor" rows="4">{{ old('mail_choose_rev', $setting->mail_choose_rev ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mail - Choose Author</label>
            <div class="col-sm-10">
                <textarea name="mail_choose_ath" id="mail_choose_ath" class="form-control ckeditor" rows="4">{{ old('mail_choose_ath', $setting->mail_choose_ath ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mail - Revised Submission</label>
            <div class="col-sm-10">
                <textarea name="mail_reviesed" id="mail_reviesed" class="form-control ckeditor" rows="4">{{ old('mail_reviesed', $setting->mail_reviesed ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mail - Manuscript Accepted</label>
            <div class="col-sm-10">
                <textarea name="mail_manu_accept" id="mail_manu_accept" class="form-control ckeditor" rows="4">{{ old('mail_manu_accept', $setting->mail_manu_accept ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mail - Manuscript Rejected</label>
            <div class="col-sm-10">
                <textarea name="mail_manu_reject" id="mail_manu_reject" class="form-control ckeditor" rows="4">{{ old('mail_manu_reject', $setting->mail_manu_reject ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Mail - Manuscript Published</label>
            <div class="col-sm-10">
                <textarea name="mail_manu_pub" id="mail_manu_pub" class="form-control ckeditor" rows="4">{{ old('mail_manu_pub', $setting->mail_manu_pub ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="journal" role="tabpanel">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">About Journal</label>
            <div class="col-sm-10">
                <textarea id="about_journal" name="about_journal" class="form-control ckeditor">{{ old('about_journal', $setting->about_journal ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Journal Metrics</label>
            <div class="col-sm-10">
                <textarea name="journal_metrics" class="form-control ckeditor">{{ old('journal_metrics', $setting->journal_metrics ?? '') }}</textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Journal Picture</label>
            @if(isset($setting->journal_pic) && !empty($setting->journal_pic))

            <div class="col-lg-5">
                <input type="file" id="journal_pic" name="journal_pic" class="form-control-file">
                <i>Max Size: upto 2 MB</i>

            </div>
            <div class="col-lg-2">
                <img src="{{url('uploads').'/'.$setting->journal_pic}}" alt="journal_pic" title="journal_pic" />
            </div>
            @else
            <div class="col-lg-5">
                <input type="file" id="journal_pic" name="journal_pic" class="form-control-file">
            </div>
            @endif

        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Journal eISSN</label>
            <div class="col-sm-10">
                <input type="text" name="journal_epub" class="form-control" placeholder="eISSN" value="{{ old('journal_epub', $setting->journal_epub ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Journal pISSN</label>
            <div class="col-sm-10">
                <input type="text" name="journal_ppub" class="form-control" placeholder="pISSN" value="{{ old('journal_ppub', $setting->journal_ppub ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Short Name</label>
            <div class="col-sm-10">
                <input type="text" name="journal_short_name" class="form-control" placeholder="Short Name" value="{{ old('journal_short_name', $setting->journal_short_name ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Full Name</label>
            <div class="col-sm-10">
                <input type="text" name="journal_name" class="form-control" placeholder="Full Name" value="{{ old('journal_name', $setting->journal_name ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Publisher</label>
            <div class="col-sm-10">
                <input type="text" name="publisher" class="form-control" placeholder="Publisher Name" value="{{ old('publisher', $setting->publisher ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Template</label>
            <div class="col-sm-10">
                <input type="text" name="template" class="form-control" placeholder="Template File URL or Path" value="{{ old('template', $setting->template ?? '') }}" readonly>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="guidelines" role="tabpanel">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Author Guide</label>

            @if(isset($setting->author_guide) && !empty($setting->author_guide))

            <div class="col-lg-5">
                <input type="file" id="author_guide" name="author_guide" class="form-control-file">

            </div>
            <div class="col-lg-2">

                <a href="{{url('uploads').'/'.$setting->author_guide}}" alt="author_guide" title="author_guide" target="_blank">Pdf<i class="fa fa-download"></i></a>
            </div>
            @else
            <div class="col-lg-5">
                <input type="file" id="author_guide" name="author_guide" class="form-control-file">
            </div>
            @endif
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Manuscript Guide</label>
            @if(isset($setting->manuscript_guide) && !empty($setting->manuscript_guide))

            <div class="col-lg-5">
                <input type="file" id="manuscript_guide" name="manuscript_guide" class="form-control-file">

            </div>
            <div class="col-lg-2">

                <a href="{{url('uploads').'/'.$setting->manuscript_guide}}" alt="manuscript_guide" title="manuscript_guide" target="_blank">Pdf<i class="fa fa-download"></i></a>
            </div>
            @else
            <div class="col-lg-5">
                <input type="file" id="manuscript_guide" name="manuscript_guide" class="form-control-file">
            </div>
            @endif

        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Copyright Form</label>
            @if(isset($setting->copyright_form_doc) && !empty($setting->copyright_form_doc))

            <div class="col-lg-5">
                <input type="file" id="copyright_form_doc" name="copyright_form_doc" class="form-control-file">

            </div>
            <div class="col-lg-2">
                <a href="{{url('uploads').'/'.$setting->copyright_form_doc}}" alt="copyright_form_doc" title="copyright_form_doc" target="_blank">Pdf<i class="fa fa-download"></i></a>

            </div>
            @else
            <div class="col-lg-5">
                <input type="file" id="copyright_form_doc" name="copyright_form_doc" class="form-control-file">
            </div>
            @endif

        </div>
    </div>
    <div class="tab-pane fade" id="security" role="tabpanel">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Author reCAPTCHA Secret Key</label>
            <div class="col-sm-10">
                <input type="text" name="ath_secret_key" class="form-control" placeholder="Enter Author reCAPTCHA Secret Key" value="{{ old('ath_secret_key', $setting->ath_secret_key ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Author reCAPTCHA Site Key</label>
            <div class="col-sm-10">
                <input type="text" name="ath_site_key" class="form-control" placeholder="Enter Author reCAPTCHA Site Key" value="{{ old('ath_site_key', $setting->ath_site_key ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Reviewer reCAPTCHA Secret Key</label>
            <div class="col-sm-10">
                <input type="text" name="rev_secret_key" class="form-control" placeholder="Enter Reviewer reCAPTCHA Secret Key" value="{{ old('rev_secret_key', $setting->rev_secret_key ?? '') }}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Reviewer reCAPTCHA Site Key</label>
            <div class="col-sm-10">
                <input type="text" name="rev_site_key" class="form-control" placeholder="Enter Reviewer reCAPTCHA Site Key" value="{{ old('rev_site_key', $setting->rev_site_key ?? '') }}">
            </div>
        </div>
    </div>
</div>