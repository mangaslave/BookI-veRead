<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'cover_url',
        'format_id',
        'opinion',
        'image_path',
        'user_id',
    ];
    

    public function format()
    {
        return $this->belongsTo(Format::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
