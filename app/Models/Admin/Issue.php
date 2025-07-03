<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $table = 'issues';

    protected $fillable = [
        'alias',
        'name',
        'volume_id',
        'type',
        'edition',
        'pages',
        'special',
        'issue_topic',
        'cover',
        'status',
        'ebook',
        'coming',
        'current',
        'vstatus',
        'created_by',
    ];

    protected $casts = [
        'special' => 'integer',
        'status' => 'boolean',
        'coming' => 'boolean',
        'current' => 'boolean',
        'vstatus' => 'integer',
    ];

    public function volume()
    {
        return $this->belongsTo(Volume::class, 'volume_id');
    }
}
