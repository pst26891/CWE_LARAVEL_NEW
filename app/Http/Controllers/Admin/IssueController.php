<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Issue;
use App\Models\Admin\Volume;

class IssueController extends MyController
{

  private int $perPage = 20;

  public function index()
  {
    $data = [
      'volume' => Volume::pluck('name', 'id'),
      'mlist' => Issue::with('volume')
        ->orderByDesc('id')
        ->paginate($this->perPage),
    ];
    return $this->adminView('admin.issue.index', $data, true, $this->perPage);
  }

  public function search(Request $request)
  {
    $query = Issue::orderByDesc('id');

    if ($request->filled('sname')) {
      $query->where('name', 'like', '%' . $request->sname . '%');
    }
    if ($request->filled('volume_id')) {
      $query->where('volume_id', $request->volume_id);
    }
    if ($request->filled('status')) {
      $query->where('status', $request->status);
    }

    $data = [
      'volume' => Volume::pluck('name', 'id'),
      'mlist' => $query->paginate($this->perPage)->appends($request->all()),
    ];

    return $this->adminView('admin.issue.index', $data);
  }

  public function create()
  {
    return $this->adminView('admin.issue.create', ['volumes' => Volume::pluck('name', 'id')]);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'volume_id' => 'required',
      'alias' => 'required|max:200',
      'issue_topic' => 'nullable|max:300',
      'pages' => 'nullable|max:200',
      'cover' => 'nullable|file|max:51200|mimes:jpeg,jpg,png',
      'name' => 'required|max:200',
      'status' => 'required|numeric',
    ]);

    if ($request->hasFile('cover')) {
      $validated['cover'] = $request->file('cover')->store('uploads', 'public');
      $validated['cover'] = basename($validated['cover']);
    }

    $validated['coming'] = $validated['current'] = $validated['status'] = 0;
    $validated['created_by'] = Auth::id();

    Issue::create([
      'name'       => $request->name,
      'alias'      => $request->alias,
      'status'     => $request->status,
      'created_by' => Auth::id(),
      'volume_id'   => $request->volume_id,
      'issue_topic'  => $request->issue_topic,
      'pages'       => $request->pages,
      'edition'       => $request->edition,
      'cover'       => $validated['cover'],
      'ebook'       => $request->ebook,
    ]);

    return redirect()->route('admin.issue.index')->with('success', 'Issue created successfully.');
  }

  public function edit($id)
  {
    return $this->adminView('admin.issue.edit', [
      'volumes' => Volume::pluck('name', 'id'),
      'issue' => Issue::findOrFail($id),
    ]);
  }

  public function update(Request $request, $id)
  {

    $issue = Issue::findOrFail($id);

    $validated = $request->validate([
      'volume_id' => 'required',
      'alias' => 'required|max:200',
      'issue_topic' => 'nullable|max:300',
      'pages' => 'nullable|max:200',
      'cover' => 'nullable|file|max:51200|mimes:pdf,jpeg,jpg,png',
      'name' => 'required|max:200',
      'status' => 'required|numeric',

    ]);

    if ($request->hasFile('cover')) {
      $validated['cover'] = $request->file('cover')->store('uploads', 'public');
      $validated['cover'] = basename($validated['cover']);
    } else {
      $validated['cover'] = $issue->cover;
    }



    $issue->update([
      'name'       => $request->name,
      'alias'      => $request->alias,
      'status'    => $request->status,
      'created_by' => Auth::id(),
      'issue_topic' => $request->issue_topic,
      'pages' => $request->pages,
      'edition' => $request->edition,
      'volume_id' => $request->volume_id,
      'cover' => $validated['cover'],
      'ebook' => $request->ebook,
    ]);

    return back()->with('success', 'Issue updated successfully.');
  }

  public function changeStatus($id, $type)
  {
    $validTypes = ['coming', 'current', 'special'];

    if (!in_array($type, $validTypes)) {
      return back()->with('error', 'Invalid status type.');
    }

    Issue::query()->update([$type => 0]);
    Issue::where('id', $id)->update([$type => 1]);

    return back()->with('success', 'Issue status updated successfully.');
  }
}
