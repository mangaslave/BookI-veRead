<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Format extends Model
{
    use HasFactory;

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}

