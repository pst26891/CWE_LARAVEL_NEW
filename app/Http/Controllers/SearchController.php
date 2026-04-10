<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use App\Models\Admin\Article;
use App\Models\Admin\Widget;

class SearchController extends MyController
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'required|min:2'
        ]);

        $search = trim($request->search);

        $articles = Article::with('volumeInfo', 'issue')
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('abstract', 'LIKE', "%{$search}%")
                    ->orWhere('keyword', 'LIKE', "%{$search}%")
                    ->orWhere('doi', 'LIKE', "%{$search}%");
            })
            ->orderByRaw("
                CASE 
                    WHEN title LIKE ? THEN 1
                    WHEN keyword LIKE ? THEN 2
                    ELSE 3
                END
            ", ["%{$search}%", "%{$search}%"])
            ->latest()
            ->paginate(10)
            ->appends(['search' => $search]);

        $leftWidgets = Widget::where('status', 0)
            ->where('layout_type', 1)
            ->orderBy('order')
            ->get();

        return view('search', compact(
            'articles',
            'leftWidgets',
            'search'
        ));
    }
}