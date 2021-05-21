<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content_raw',
        'is_published',
        'published_at',
        'user_id',
    ];
    /**
     * @var mixed
     */

    /**
     * Категория статьи.
     *
     * @return BelongsTo
     */
    public function category() {
         // Статья принадлежит категории
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     * Автор статьи.
     *
     * @return BelongsTo
     */
    public function user() {
        // Статья принадлежит юзеру
        return $this->belongsTo(User::class);
    }
}
