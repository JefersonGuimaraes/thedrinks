<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function drinks()
    {
        return $this->belongsToMany(Drink::class, 'categories_drinks', 'fk_category', 'fk_drink');
    }
}
