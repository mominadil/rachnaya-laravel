<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'bio',
        'slug',
        'status'
    ];

    public function setNameAttribute($publisher_slug)
    {
        $this->attributes['name'] = $publisher_slug;
        $this->attributes['slug'] = Str::slug($publisher_slug);

    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
