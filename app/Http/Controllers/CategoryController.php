<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
  public function drinks()
  {
      return $this->belongsToMany(Drink::class, 'categories_drink', 'fk_category', 'fk_drink');
  }

  public static function getCategories()
  {
    return Category::all();
  }

}