<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'articles'; // Explicitly defining table name

    protected $fillable = [
        'manuscript_no',
        'order_no',
        'post_id',
        'title',
        'description',
        'url',
        'article_type_id',
        'doi',
        'volume',
        'number',
        'abstract',
        'keyword',
        'article_citation',
        'url_citation',
        'mla',
        'apa',
        'ama',
        'chicago',
        'page_no',
        'upload_pdf',
        'pdf_locate',
        'received',
        'accepted',
        'pub_date_o',
        'pub_date_p',
        'plagrism_check_date',
        'first_reviewer',
        'first_rev_email',
        'first_rev_orcid_id',
        'first_rev_publons',
        'second_reviewer',
        'sec_rev_email',
        'sec_rev_orcid_id',
        'sec_rev_publons',
        'final_approval_date',
        'final_approval_by',
        'final_link',
        'pdf_download_link',
        'pdf_link',
        'download',
        'view',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'publisher_name',
        'category',
        'composing',
        'proofread',
        'authors',
        'date',
        'article_status',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Get the author of the article.
     */
    // public function author()
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }

    /**
     * Get the article type.
     */
    public function articleType()
    {
        return $this->belongsTo(ArticleType::class, 'article_type_id');
    }

    /**
     * Get the volume associated with the article.
     */
    public function volume()
    {
        return $this->belongsTo(Volume::class, 'volume');
    }

    public function volumeInfo()
    {
        return $this->belongsTo(Volume::class, 'volume');
    }
    
    public function issue()
    {
        return $this->belongsTo(Issue::class, 'number'); // Replace 'issue_id' with the actual foreign key column name
    }

    /**
     * Scope to filter active articles.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Scope to search articles by title.
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where('title', 'LIKE', "%{$keyword}%")
            ->orWhere('description', 'LIKE', "%{$keyword}%");
    }


    public function affiliation()
    {
        return $this->hasMany(Affiliation::class, 'article_id');
    }

    public function author()
    {
        return $this->hasMany(Author::class, 'article_id');
    }
}
