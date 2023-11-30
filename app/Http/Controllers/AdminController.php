<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Drink;
use App\Http\Controllers\CategoryController;

class AdminController extends Controller{

  /**
   * Método responsável por controlar o acesso a página de administração
   *
   */
  public function index(){
    $css = 'admin';

    $user = $this->getUser();

    $drinks = Drink::with('categories')->get();
    
    $categories = CategoryController::getCategories();

    return view('admin/index', [
                                'css'         => $css,
                                'user'        => $user,
                                'drinks'      => $drinks,
                                'categories'  => $categories                                
                               ]);
  }


  /**
   * Método responsável por controlar o acesso a página de login
   *
   */
  public function login(){
    $css = 'login';
    return view('auth/login', ['css' => $css]);
  }


  /**
   * Método responsável por obter os dados do usuário logado
   *
   * @return array
   */
  public static function getUser(){
    return auth()->user();
  }
}