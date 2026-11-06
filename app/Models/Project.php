<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'company_or_client',
        'image_path',
        'date_completed',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}