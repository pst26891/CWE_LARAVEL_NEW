<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Setting;
use Illuminate\Support\Facades\Auth;
use App\Services\FileUploadService;


class SettingController extends MyController
{
    public function edit($id)
    {
        $data['setting'] = Setting::findOrFail($id);

        return $this->adminView('admin.setting.edit', $data);

    }

    /**
     * Update the specified setting in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'site_url'           => 'required',
            'site_title'         => 'required|string|max:255',
            'tagline'            => 'required|string|max:255',
            'logo'               => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'logo_small'         => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'journal_pic'         => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
            'favicon'            => 'nullable|image|mimes:ico,png|max:1024',
            'phone'              => 'nullable|string|max:20',
            'email'              => 'nullable|email|max:255',
            'address'            => 'nullable|string',
            'facebook'           => 'nullable|url',
            'twitter'            => 'nullable|url',
            'linkedin'           => 'nullable|url',
            'youtube'            => 'nullable|url',
            'mail_ath_reg'       => 'nullable|string',
            'mail_rev_reg'       => 'nullable|string',
            'mail_manu_submit'   => 'nullable|string',
            'mail_send_resub'    => 'nullable|string',
            'mail_choose_rev'    => 'nullable|string',
            'mail_choose_ath'    => 'nullable|string',
            'mail_reviesed'      => 'nullable|string',
            'mail_manu_accept'   => 'nullable|string',
            'mail_manu_reject'   => 'nullable|string',
            'mail_manu_pub'      => 'nullable|string',
            'about_journal'      => 'nullable|string',
            'metrics'            => 'nullable|string',
            'publisher'          => 'nullable|string',
            'author_guide'       => 'nullable|mimes:pdf|max:2048',
            'manuscript_guide'   => 'nullable|mimes:pdf|max:2048',
            'templates'          => 'nullable|string',
            'copyright'          => 'nullable|mimes:pdf|max:2048',
            'captcha_key_author' => 'nullable|string',
            'captcha_key_reviewer' => 'nullable|string',
            'status'             => 'nullable|in:0,1',
        ]);
    
        $setting = Setting::findOrFail($id);
    
        $data = $request->only([
            'site_url', 'site_title', 'tagline', 'favicon',
            'phone', 'email', 'address', 'facebook', 'twitter', 'linkedin', 'youtube',
            'mail_ath_reg', 'mail_rev_reg', 'mail_manu_submit', 'mail_send_resub',
            'mail_choose_rev', 'mail_choose_ath', 'mail_reviesed',
            'mail_manu_accept', 'mail_manu_reject', 'mail_manu_pub',
            'about_journal', 'metrics', 'publisher',
            'author_guide', 'manuscript_guide', 'templates', 'copyright',
            'captcha_key_author', 'captcha_key_reviewer',
            'status','about_us',
        ]);
    
        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo'] = FileUploadService::uploadImages($request->file('logo'));
        }

        // Handle author_guide upload
        if ($request->hasFile('author_guide')) {
            $data['author_guide'] = FileUploadService::uploadImages($request->file('author_guide'));
        }
    
        // Handle favicon upload (if needed)
        if ($request->hasFile('favicon')) {
            $data['favicon'] = FileUploadService::uploadImages($request->file('favicon'));
        }

        // Handle Logo Small upload (if needed)
        if ($request->hasFile('logo_small')) {
            $data['logo_small'] = FileUploadService::uploadImages($request->file('logo_small'));
        }
         // Handle manuscript guide upload (if needed)
         if ($request->hasFile('copyright')) {
            $data['copyright'] = FileUploadService::uploadImages($request->file('copyright'));
        }
        
         // Handle copyright form upload (if needed)
         if ($request->hasFile('manuscript_guide')) {
            $data['manuscript_guide'] = FileUploadService::uploadImages($request->file('manuscript_guide'));
        }

         // Handle journal_pic form upload (if needed)
         if ($request->hasFile('journal_pic')) {
            $data['journal_pic'] = FileUploadService::uploadImages($request->file('journal_pic'));
        }
    
        $data['updated_by'] = Auth::id();
    
        $setting->update($data);
    
        return redirect()->route('admin.setting.edit', 1)->with('success', 'Settings updated successfully.');
    }
    
    
}
