<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItem extends Model
{
    use HasFactory;

    protected $table = 'menuitems';

    protected $fillable = [
        'title',
        'name',
        'slug',
        'type',
        'target',
        'menu_id',
        'depth',
    ];

    public $timestamps = true;

    /**
     * Get the menu this item belongs to.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
