<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Article extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'author',
        'category_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'status',
        'image',
        'published_date',
        'views',
    ];
    public function Author()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tag_id');
    }

}
