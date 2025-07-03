<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyController;

use Illuminate\Http\Request;
use App\Models\Admin\Article;
use App\Models\Admin\Volume;
use App\Models\Admin\Issue;
use App\Models\Admin\Widget;

class ArticleController extends MyController
{
    public function viewArticle($volIssue, $articleSlug)
    {
        $data['article'] = Article::with(['volumeInfo', 'issue', 'author','affiliation'])->where('url','=',$articleSlug)->firstOrFail();
        $data['leftWidgets'] = Widget::where('status', 0)->where('layout_type', 1)->orderBy('order')->get();
        $data['rightWidgets'] = Widget::where('status', 0)->where('layout_type', 2)->orderBy('order')->get();
        return view('single_article', $data);
    }

     public function viewAbstract($articleId)
    {
        $data['article'] = Article::with(['volumeInfo', 'issue', 'author','affiliation'])->where('id','=',$articleId)->firstOrFail();
        $data['leftWidgets'] = Widget::where('status', 0)->where('layout_type', 1)->orderBy('order')->get();
        $data['rightWidgets'] = Widget::where('status', 0)->where('layout_type', 2)->orderBy('order')->get();
        return view('abstract_article', $data);
    }
}
