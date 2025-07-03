<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pages'; // Table name

    protected $fillable = [
        'parent',
        'cat',
        'url',
        'dlink',
        'ord',
        'image',
        'title',
        'description',
        'status',
        'position',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'page_type',
        'template',
        'created_by',
        'updated_by'
    ];

    protected $dates = ['deleted_at']; // Enable soft deletes

    /**
     * Get the parent page.
     */
    public function parentPage()
    {
        return $this->belongsTo(Page::class, 'parent');
    }

    /**
     * Get the child pages.
     */
    public function childPages()
    {
        return $this->hasMany(Page::class, 'parent');
    }

    /**
     * Get the user who created the page.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the page.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
