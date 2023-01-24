<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Keywords extends Model
{
    use HasFactory;

    protected $fillable = ['keywords','slug'];



    public function setKeywordsAttribute($keywords_slug)
    {
        $this->attributes['keywords'] = $keywords_slug;
        $this->attributes['slug'] = Str::slug($keywords_slug);

    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
