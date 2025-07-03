<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'article_id',
        'order_no',
        'manuscript_no',
        'title',
        'f_name',
        'm_name',
        'l_name',
        'affiliation',
        'email',
        'orcid_id',
        'correspond_author',
        'status',
    ];

    /**
     * Get the article associated with the author.
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
    
}
