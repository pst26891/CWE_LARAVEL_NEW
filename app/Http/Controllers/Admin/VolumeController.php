<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Volume;
use Illuminate\Support\Facades\Auth;

class VolumeController extends MyController
{
    private $__perPage = 10;

    public function __construct()
    {
        // Enable query log only for debugging purposes (Remove in production)
        // \DB::enableQueryLog();
    }

    /**
     * Display a listing of the volumes.
     */
    public function index()
    {
        $data['mlist'] = Volume::orderByDesc('id')
            ->paginate($this->__perPage);

        return $this->adminView('admin.volume.index', $data);
    }

    /**
     * Search and filter volumes.
     */
    public function search(Request $request)
    {
        $query = Volume::orderByDesc('id');

        if (!empty($request->sname)) {
            $query->where('name', 'like', '%' . $request->sname . '%');
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $data['mlist'] = $query->latest()->paginate($this->__perPage);
        $data['mlist']->appends($request->all());

        return $this->adminView('admin.volume.index', $data);

    }

    /**
     * Show the form for creating a new volume.
     */
    public function create()
    {
        return $this->adminView('admin.volume.create');
    }

    /**
     * Store a newly created volume in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:volumes|max:200',
            'alias' => 'nullable|max:200',
            'status' => 'required|numeric',
        ]);

        Volume::create([
            'name'       => $request->name,
            'alias'      => $request->alias,
            'status'     => $request->status,
            'created_by' => Auth::id(),
        ]);
        

        return redirect()->route('admin.volume.index')->with('success', 'Volume has been created successfully.');
    }

    /**
     * Show the form for editing the specified volume.
     */
    public function edit($id)
    {
        $data['volume'] = Volume::findOrFail($id);
        return $this->adminView('admin.volume.edit', $data);

    }

    /**
     * Update the specified volume in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:200',
            'alias' => 'nullable|max:200',
            'status' => 'required|numeric',
        ]);

        $volume = Volume::findOrFail($id);
        $volume->update([
            'name'       => $request->name,
            'alias'      => $request->alias,
            'status'    => $request->status,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.volume.index')->with('success', 'Volume has been updated successfully.');
    }
}
