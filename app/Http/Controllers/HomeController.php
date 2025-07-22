<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use App\Models\Admin\Volume;
use App\Models\Admin\Issue;

use App\Models\Admin\Page;
use App\Models\Admin\Article;
use App\Models\Admin\Setting;
use App\Models\Admin\Widget;

use DB;
use Mail;
use Route;


class HomeController extends MyController
{
    public function __construct()
    {
        ini_set('max_execution_time', 300);
    }

    function index()
    {

        $data['setting'] = Setting::findOrFail(1);
        $data['leftWidgets'] = Widget::where('status', 0)->where('layout_type', 1)->orderBy('order')->get();
        $data['rightWidgets'] = Widget::where('status', 0)->where('layout_type', 2)->orderBy('order')->get();

        $data['mostViewed'] = Article::with(['volume', 'issue', 'author'])->orderByDesc('total_view')->take(5)->get();
        $data['mostDownloaded'] = Article::with(['volume', 'issue', 'author'])->orderByDesc('total_download')->take(5)->get();
        $data['mostLatest'] = Article::with(['volume', 'issue', 'author'])->where('status', 1)->orderByDesc('id')->take(5)->get();

        return view('home', $data);
    }

    function getSetting()
    {
        $setting = Setting::first();
        return $setting;
    }

    function showPage($slug)
    {
        // Generate two random numbers
        $a = rand(1, 9);
        $b = rand(1, 9);
        session(['simple_captcha' => $a + $b]);
        $data['captcha'] = $a . ' + ' . $b . ' = ?';

        $data['pageContent'] = Page::where('url', '=', $slug)->first();
        $data['setting'] = Setting::findOrFail(1);
        $data['leftWidgets'] = Widget::where('status', 0)->where('layout_type', 1)->orderBy('order')->get();
        $data['rightWidgets'] = Widget::where('status', 0)->where('layout_type', 2)->orderBy('order')->get();

        $data['sidebarNav'] = Page::where('parent', '=', $data['pageContent']->parent)->orderBy('title', 'ASC')->get();
        $data['comingIssue'] = Issue::with('volume')->where('coming', '=', '1')->first();
        $data['currentIssue'] = Issue::with('volume')->where('current', '=', '1')->first();
        // $data['editorial_categories'] = DB::table('editorial_categories')
        //     ->where(['status' => 'active'])
        //     ->orderBy('ord', 'ASC')->get();

        //$data['volumes'] = Volume::where('status', '=', '0')->orderBy('id', 'ASC')->get();
        $data['volumes'] = Volume::where('status', 0)
            ->with(['issues' => function ($q) {
                $q->where('status', 0);
            }])
            ->get();
        return view('page', $data);
    }

    function showChiled($parent, $slug)
    {
        // Generate two random numbers
        $a = rand(1, 9);
        $b = rand(1, 9);
        session(['simple_captcha' => $a + $b]);
        $data['captcha'] = $a . ' + ' . $b . ' = ?';

        $data['setting'] = Setting::findOrFail(1);
        $data['leftWidgets'] = Widget::where('status', 0)->where('layout_type', 1)->orderBy('order')->get();
        $data['rightWidgets'] = Widget::where('status', 0)->where('layout_type', 2)->orderBy('order')->get();
        $data['pageContent'] = Page::where('url', '=', $slug)->first();
        $data['sidebarNav'] = Page::where('parent', '=', $data['pageContent']->parent)->orderBy('title', 'ASC')->get();
        $data['comingIssue'] = Issue::with('volume')->where('coming', '=', '1')->first();
        $data['currentIssue'] = Issue::with('volume')->where('current', '=', '1')->first();

        return view('page', $data);
    }


    public function contactSave(Request $request)
    {

        request()->validate(
            [
                'email' => 'required|email',
                'yname' => 'required',
                'pnumber' => 'required|numeric',
                'captcha_answer' => 'required|numeric',

            ]
        );

        if ($request->captcha_answer != session('simple_captcha')) {
            return back()->withErrors(['captcha_answer' => 'Incorrect captcha answer.'])->withInput();
        }

        \Mail::send(
            'emails.contact_email',
            array(
                'yname' => $request->get('yname'),
                'email' => $request->get('email'),
                'subject' => "Contact Us",
                'pnumber' => $request->get('pnumber'),
                'comment' => $request->get('comment'),
            ),
            function ($message) use ($request) {
                $message->from($request->email);
                $message->to($this->getSetting()->con_email)->subject('Contact Us');
            }
        );

        return back()->with('success', 'Thank you for contact us!');
    }

    public function sendSubmission(Request $request)
    {

        $validatedData = $request->validate([
            'article_type' => 'required|string',
            'article_title' => 'required|string',
            'corr_authur_fname' => 'required|string',
            'corr_author_lname' => 'required|string',
            'corr_author_email' => 'required|email',
            'corr_author_contact' => 'required|string',
            'country' => 'required|string',
            'message' => 'required|string',
            'first_check' => 'required|accepted',
            'second_check' => 'required|accepted',
            'captcha_answer' => 'required|numeric',
        ]);

        if ($request->captcha_answer != session('simple_captcha')) {
            return back()->withErrors(['captcha_answer' => 'Incorrect captcha answer.'])->withInput();
        }

        $uploadedFiles = explode(',', $request->input('uploaded_files', ''));
         \Mail::send('emails.submission_email', [$validatedData], function ($message) use ($request, $uploadedFiles) {
            $message->to('pushpendra26891@gmail.com')
                    ->from('pst26891@gmail.com') // Change this to actual recipient
                    ->subject('New Manuscript Submission');

                    foreach ($uploadedFiles as $filename) {
                $path = public_path('temp_uploads/' . $filename);
                if (file_exists($path)) {
                    $message->attach($path);
                }
            }
        });

         // Clean up temp files
        foreach ($uploadedFiles as $filename) {
            $path = public_path('temp_uploads/' . $filename);
            if (file_exists($path)) {
                unlink($path);
            }
        }



        // \Mail::send(
        //     'emails.submission_email',
        //     array(
        //         'corr_author_name' => $request->get('corr_author_name'),
        //         'corr_email' => $request->get('corr_email'),
        //         'subject' => "Manuscript Submission",
        //         'corr_number' => $request->get('corr_number'),
        //         'manuscript' => "Attachment",
        //         'copyright' => "Attachment",
        //     ),
        //     function ($message) use ($request) {
        //         $message->from('pushpendra26891@gmail.com');
        //         $to = $this->getSetting()->con_email;
        //         $message->to($to)->subject('Manuscript Submission');
        //         $message->attach($request->file('manuscript')->getRealPath(), [
        //             'as'  => $request->file('manuscript')->getClientOriginalName(),
        //             'mime' => $request->file('manuscript')->getClientMimeType(),
        //         ]);
        //         $message->attach($request->file('copyright')->getRealPath(), [
        //             'as'  => $request->file('copyright')->getClientOriginalName(),
        //             'mime' => $request->file('copyright')->getClientMimeType(),
        //         ]);
        //     }
        // );

        return back()->with('success', 'Thank you for Submission!');
    }

     // This handles the AJAX Dropzone uploads
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:doc,docx,jpeg,jpg,png,pdf|max:5120',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $path = public_path('temp_uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file->move($path, $filename);

        return response()->json(['name' => $filename]);
    }

    protected function decodeMenuContent($menu)
    {
        if (empty($menu) || empty($menu->content)) {
            return [];
        }

        $data = is_string($menu->content)
            ? json_decode($menu->content)
            : $menu->content;

        // Case: content is a single object
        if (is_object($data)) {
            return [$data];
        }

        // Case: content is a wrapped array (e.g., [[{...}, {...}]])
        if (is_array($data)) {
            // Case: outer array has a nested array as its first element
            if (isset($data[0]) && is_array($data[0])) {
                return $data[0]; // ✅ Return the full inner array (not just one item)
            }

            // Case: already a flat array of menu items
            return $data;
        }

        return [];
    }

    protected function enrichMenuTree(array &$itemsFront)
    {
        foreach ($itemsFront as &$itemFront) {
            if (!is_object($itemFront)) {
                continue;
            }

            //  print_r($itemsFront); die();
            // Enrich current node
            $model = MenuItem::find($itemFront->id);
            if ($model) {
                $itemFront->title  = $model->title;
                $itemFront->name   = $model->name;
                $itemFront->slug   = $model->slug;
                $itemFront->target = $model->target;
                $itemFront->type   = $model->type;
            }

            // Normalize children property
            $children = [];
            if (isset($itemFront->children) && is_array($itemFront->children)) {
                $raw = $itemFront->children[0] ?? $itemFront->children;
                if (is_array($raw)) {
                    $children = $raw;
                }
            }

            $itemFront->children = [];
            if (!empty($children)) {
                $this->enrichMenuTree($children);
                $itemFront->children = $children;
            }
        }
    }
}
