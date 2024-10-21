<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'slug', 'desc', 'img', 'views', 'status', 'puublish_date'];

    // relasi ke kategori

    public function Category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
