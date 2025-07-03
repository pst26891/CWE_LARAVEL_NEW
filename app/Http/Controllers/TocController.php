<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Volume;
use App\Models\Admin\Issue;
use App\Models\Admin\Article;
use App\Models\Admin\Widget;
class TocController extends Controller
{
    /**
     * Show the table of contents for a given volume and issue.
     */
    public function show($volumeAlias, $issueAlias)
    {
        $volume = Volume::where('alias', $volumeAlias)->where('status', 0)->firstOrFail();
        $issue = Issue::where('alias', $issueAlias)
            ->where('volume_id', $volume->id)
            ->where('status', 0)
            ->firstOrFail();

        $articles = Article::where('number', $issue->id)
            ->where('status', 1)
            ->with('author')
            ->orderBy('id')
            ->get();

        $leftWidgets = Widget::where('status', 0)->where('layout_type', 1)->orderBy('order')->get();
        $rightWidgets = Widget::where('status', 0)->where('layout_type', 2)->orderBy('order')->get();

        return view('toc', [
            'volume' => $volume,
            'issue' => $issue,
            'articles' => $articles,
            'leftWidgets' => $leftWidgets,
            'rightWidgets' => $rightWidgets,
        ]);
    }

    /**
     * Show the ebook view for a given volume and issue.
     */
    public function ebook($volumeAlias, $issueAlias)
    {
        $volume = Volume::where('alias', $volumeAlias)->where('status', 0)->firstOrFail();
        $issue = Issue::where('alias', $issueAlias)
            ->where('volume_id', $volume->id)
            ->where('status', 0)
            ->firstOrFail();

        return view('ebook', [
            'volume' => $volume,
            'issue' => $issue,
        ]);
    }

    /**
     * Generate the feed for a given volume and issue.
     */
    public function feed($volumeAlias, $issueAlias)
    {
        $volume = Volume::where('alias', $volumeAlias)->where('status', 0)->firstOrFail();
        $issue = Issue::where('alias', $issueAlias)
            ->where('volume_id', $volume->id)
            ->where('status', 0)
            ->firstOrFail();

        $articles = Article::where('number', $issue->id)
            ->where('status', 1)
            ->with('author')
            ->orderBy('id')
            ->get();

        return response()
            ->view('feed', [
                'volume' => $volume,
                'issue' => $issue,
                'articles' => $articles,
            ])
            ->header('Content-Type', 'application/xml');
    }
}
