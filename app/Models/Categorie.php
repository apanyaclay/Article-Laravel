<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
    ];
    public function parent()
    {
        return $this->belongsTo(Categorie::class, 'parent_id');
    }

    public function Articles()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }
}
