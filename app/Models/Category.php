<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


    protected $fillable = [
        'category_name',
        'type_id'
    ];

    public function type()
    {
        return $this->belongsTo(CategoryType::class);
    }
}
