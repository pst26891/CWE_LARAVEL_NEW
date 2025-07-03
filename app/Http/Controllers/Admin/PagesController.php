<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MyController;
use App\Models\Admin\Page;
use App\Models\Admin\PageTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PagesController extends MyController
{
  
    protected $repository;
    private $__perPage = 10;

    public function __construct()
    {
      DB::enableQueryLog();

    } 

    public function index()
    {
       $data['pages'] = Page::latest()->paginate($this->__perPage);
       return $this->adminView('admin.page.index', $data, true, $this->__perPage);
    }

    public function search(Request $request)
    {
        $filters = [['id', '!=', 0]];

        if (!empty($request->sname)) {
            $filters[] = ['title', 'like', '%' . $request->sname . '%'];
        }

        if ($request->has('status')) {
            $filters[] = ['status', '=', $request->status];
        }

        $data['pages'] = Page::latest()->where($filters)->paginate($this->__perPage);
        $data['pages']->appends($request->all());

        return $this->adminView('admin.page.index', $data, true, $this->__perPage);
    }


  
    public function create()
    {
        $data = [
            'pages' => ['1' => 'None'] + Page::orderBy('title', 'asc')->pluck('title', 'id')->toArray(),
            'templates' => PageTemplate::orderBy('name', 'asc')->pluck('name', 'id')->toArray(),
        ];

        return $this->adminView('admin.page.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:pages',
            'status' => 'required|numeric',
            'template' => 'required',
        ]);

        Page::create([
            'title' => $request->title,
            'url' => Str::slug($request->title),
            'parent' => $request->parent ?? 0,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
            'template' => $request->template,
            'ord' => 0,
            'created_by' => auth()->id() ?? 0,
        ]);

        return back()->with('success', 'Page has been created successfully.');
    }

  
    public function edit(int $id)
    {
        $data = [
            'page' => Page::findOrFail($id),
            'pages' => ['1' => 'None'] + Page::orderBy('title', 'asc')->pluck('title', 'id')->toArray(),
            'templates' => PageTemplate::orderBy('name', 'asc')->pluck('name', 'id')->toArray(),

        ];

        return $this->adminView('admin.page.edit', $data);
    }



    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required|numeric',
            'template' => 'required',
        ]);

        $page = Page::findOrFail($id);
        $page->update([
            'title' => $request->title,
            'url' => Str::slug($request->title),
            'description' => $request->description,
            'parent' => $request->parent,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'status' => $request->status,
            'template' => $request->template,
        ]);

        return back()->with('success', 'Page has been updated successfully.');
    }
}
?>
