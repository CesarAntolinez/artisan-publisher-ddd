<?php

namespace Writing\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentModel extends Model
{
    use HasUuids;

    protected $table = 'comments';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'article_id',
        'author',
        'text',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(ArticleModel::class, 'article_id');
    }
}
