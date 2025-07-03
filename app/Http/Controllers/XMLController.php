<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use App\Models\admin\Article;
use App\Models\Admin\Setting;

class XMLController extends MyController
{
    public function index($voliss, $articleSlug)
    {
        $article = Article::with(['volumeInfo', 'issue', 'author','affiliation'])->where('url', $articleSlug)->first();
        $data['setting'] = Setting::findOrFail(1);

        if (!$article) {
            abort(404, 'Article not found');
        }

        return response()->view('xml', [
            'article' => $article,
            'setting' => $data['setting']
        ])->header('Content-Type', 'text/xml');
    }
}
