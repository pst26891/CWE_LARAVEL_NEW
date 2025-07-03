<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    protected $fillable = [
        'name',       // ✅ Add this
        'description',
        'order',
        'layout_type',
        'status',
    ];
}
