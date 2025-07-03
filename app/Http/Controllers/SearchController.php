<?php

namespace App\Http\Controllers;
use App\Http\Controllers\MyController;

use Illuminate\Http\Request;
use App\Models\admin\Article;
use App\Models\Admin\Widget;

class SearchController extends MyController 
{
     public function index(Request $request)
    {
        request()->validate([
            'search' => 'required'
        ]);

        $search = $request->input('search');

        $data['articles'] = Article::with('volumeInfo','issue')->when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%")
                         ->orWhere('abstract', 'like', "%{$search}%");
        })->paginate(10); // Use simplePaginate or get() if preferred
        $data['leftWidgets'] = Widget::where('status', 0)->where('layout_type', 1)->orderBy('order')->get();

        return view('search', $data);
    }
}
