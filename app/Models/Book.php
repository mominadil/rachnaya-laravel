<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Book extends Model
{
    protected $fillable = [
        'title',
        'b_id',
        'description',
        'author',
        'category',
        'publisher_name',
        'isbn',
        'pages',
        'language',
        'publishedAt',
        'avgReadingTime',
        'status',
        'contentType',
        'price',
        'preview_link',
        'hasRental',
        'hasHardbound',
        'hasPaperback',
        'category_id',
        'publisher_id',
        'originCountry',
        'lowerLimit',
        'upperLimit',
        'isActivated',
        'slug',
        'hasDigital'
    ];
    use HasFactory;

    protected $table = 'books';
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);

    }

    public function keywords()
    {
        return $this->belongsToMany(Keywords::class, 'book_keyword', 'book_id', 'keyword_id')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

}
