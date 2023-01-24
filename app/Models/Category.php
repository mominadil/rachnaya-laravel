<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['category','slug'];

    public function setCategoryAttribute($category_slug)
    {
        $this->attributes['category'] = $category_slug;
        $this->attributes['slug'] = Str::slug($category_slug);

    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
    
    public function fourBooks()
    {
        return $this->books()->take(4);
    }
}
