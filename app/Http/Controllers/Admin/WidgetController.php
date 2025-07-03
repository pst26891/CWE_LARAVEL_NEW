<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Widget;
use Illuminate\Support\Facades\Auth;

class WidgetController extends MyController
{
    private $__perPage = 10;
    public function index()
    {
        $data['mlist'] = widget::orderByDesc('id')
            ->paginate($this->__perPage);

        return $this->adminView('admin.widget.index', $data);
    }

    /**
     * Search and filter widget.
     */
    public function search(Request $request)
    {
        $query = widget::orderByDesc('id');

        if (!empty($request->sname)) {
            $query->where('name', 'like', '%' . $request->sname . '%');
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $data['mlist'] = $query->latest()->paginate($this->__perPage);
        $data['mlist']->appends($request->all());

        return $this->adminView('admin.widget.index', $data);

    }

    /**
     * Show the form for creating a new widget.
     */
    public function create()
    {
        return $this->adminView('admin.widget.create');
    }

    /**
     * Store a newly created widget in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:widgets|max:200',
            'layout_type' => 'required',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
        ]);

        widget::create([
            'name'       => $request->name,
            'layout_type'  => $request->layout_type,
            'order'      => $request->order,
            'description' => $request->description,
            'status'     => $request->status,
            'created_by' => Auth::id(),
        ]);
        

        return redirect()->route('admin.widget.index')->with('success', 'Widget has been created successfully.');
    }

    /**
     * Show the form for editing the specified widget.
     */
    public function edit($id)
    {
        $data['widget'] = widget::findOrFail($id);
        return $this->adminView('admin.widget.edit', $data);

    }

    /**
     * Update the specified widget in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:200',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
        ]);

        $widget = widget::findOrFail($id);
        $widget->update([
            'name'       => $request->name,
            'layout_type'  => $request->layout_type,
            'order'      => $request->order,
            'description' => $request->description,
            'status'    => $request->status,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.widget.index')->with('success', 'Widget has been updated successfully.');
    }
}
