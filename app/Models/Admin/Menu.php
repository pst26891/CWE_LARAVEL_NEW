<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';

    protected $fillable = [
        'title',
        'location',
        'content',
    ];

    protected $casts = [
        'content' => 'array', // If content is stored as JSON
    ];

    public $timestamps = true;
}
