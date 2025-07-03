<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    use HasFactory;

    protected $table = 'affiliations'; // Keeping the table name as in the database

    protected $fillable = [
        'article_id',
        'manuscript_no',
        'author_no',
        'full_name',
        'department',
        'inst_address',
        'inst_name',
        'inst_city',
        'pincode',
        'state',
        'country',
        'fax',
        'mobile',
        'inst_tel',
    ];

    // Define relationship with Article Model
    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id');
    }
}
