<?php

namespace Writing\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
    use HasFactory;

    protected $table = 'articles'; // Especificamos el nombre de la tabla
    public $incrementing = false; // Le decimos a Eloquent que no use un ID autoincremental
    protected $keyType = 'string'; // Le decimos que nuestra clave primaria es un string (será un UUID)

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'author_id', // Cambiamos de authorId a author_id para seguir las convenciones de Laravel en BBDD
        'title',
        'content',
        'status',
    ];

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CommentModel::class, 'article_id');
    }
}
