<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\Models\Drink;
use App\Http\Controllers\AdminController;
use App\Models\Category;
use App\Models\CategoryDrink;

use function PHPSTORM_META\map;

class DrinkController extends Controller
{

  /**
   * Método responsável por controlar a rota principal do site
   *
   */
  public function index()
  {
    $mostWanted = $this->getmostWanted(3);

    $alcoholics = $this->getAlcoholics(6);
    
    $notAlcoholics = $this->getNotAlcoholics(6);

    $scrambled = $this->getscrambled(6);
    
    $assembled = $this->getAssembled(6);
    
    $shaken = $this->getShaken(6);

    $search = request('search');


    $user = auth() ? auth()->user() : null;

    if($search){

      $results = Drink::where([
        ["name", "like", "%$search%"]
      ])->get();

    }else{

      $results = null;

    }
    
    return view('home', [
                          'user'          => $user,
                          'mostWanted'    => $mostWanted,
                          'alcoholics'    => $alcoholics,
                          'notAlcoholics' => $notAlcoholics,
                          'scrambled'     => $scrambled,
                          'assembled'     => $assembled,
                          'shaken'        => $shaken,
                          'search'        => $search,
                          'results'       => $results
                        ]);
  }

  public function store(Request $request)
  {
    // Validando se há categorias
    if ($request->categories === null) return redirect('/admin')->with('error', 'É necessário ao menos uma categoria');

    // Tratando e validando o upload da foto
    $photo = $this->upload($request);
    if ($photo === null) return redirect('/admin')->with('error', 'Imagem inválida!');

    // Instanciando a classe drink
    $drink = new Drink;
    $drink->name        = $request->name;
    $drink->ingredients = $request->ingredients;
    $drink->preparation = $request->preparation;
    $drink->photo       = $photo;
  
    // Salvando o novo objeto
    $drink->save();

    // Criando as categorias do novo drink
    foreach($request->categories as $category){
      $this->addCategory($category, $drink->id);
    }
    
    return redirect('/admin')->with('success', 'Novo drink cadastrado!');
  }

  /**
   * Método responsável por atualizar informações do drink no banco de dados
   *
   * @param Request $request
   */
  public function update(Request $request){
    $drink = Drink::findOrFail($request->id);
    // Obtendo as categorias do drink
    foreach($drink->categories as $category){
      $idCategories[] = $category->id;
    }

    // Comparando as categorias cadastradas com as enviadas
    if($idCategories != $request->categories){
      $drink->categories()->detach();

      // Criando as novas categorias do drink
      foreach($request->categories as $idCategory){
        $this->addCategory($idCategory, $drink->id);
      }
    }

    $data = $request->all();

    if ($request->photo != null) {
      // Tratando e validando o upload da foto
      echo $photo = $this->upload($request);
      if ($photo === null) return redirect('/admin')->with('error', 'Imagem inválida!');

      $data['photo'] = $photo;
      // Atualizando no banco de dados
      $drink->update($data);

    } else {

      $drink->update($request->except('photo', 'categories'));
      
    }

    return redirect('/admin')->with('success', 'Drink editado!');
  }

  /**
   * Método responsável por deletar um drink do banco de dados
   *
   * @param integer $id
   */
  public function destroy($id){
    Drink::findOrFail($id)->delete($id);

    return redirect('/admin')->with('success', 'Drink deletado!');
  }

  /**
   * Método responsável por validar e fazer upload de imagens
   *
   * @param Request $request
   * @return string
   */
  public function upload(Request $request)
  {
    try {
      $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg|max:500|square',
      ]);

      $photo = $request->file('photo');
      $photoName = time() . '.' . $photo->extension();
      $photo->move(public_path('images/drinks'), $photoName);
      return $photoName;
    } catch (ValidationException $e) {
      return null;
    }
  }

   /**
   * Método responsável por controlar a rota de exibição de drink
   *
   * @param integer $id
   */
  public function drink($id)
  {
    $user = AdminController::getUser();

    $drink = Drink::find($id);

    $this->newView($drink);

    $categoriesId = [];

    foreach($drink->categories as $category){
      $categoriesId[] = $category['id'];
    }

    // CRIANDO UM ARRAY COM OS INGREDIENTES
    $ingredients = explode('.', $drink->ingredients);

    // CRIANDO UM ARRAY COM OS PASSOS DO MODO DE PREPARO
    $preparation = explode('.', $drink->preparation);
    
    // SELECIONANDO OS DRINKS RELACIONADOS PELAS CATEGORIAS
    $related = Drink::whereHas('categories', function ($query) use ($categoriesId) {
      $query->whereIn('categories.id', $categoriesId);
    }, '=', count($categoriesId))->get();

    // RETIRANDO O DRINK SELECIONADO PELO USUÁRIO DA LISTA DE ITENS RELACIONADOS
    $related = $this->removeRelatedById($related, $id);

    return view('drink/drink', [
      'user'        => $user,
      'id'          => $id,
      'drink'       => $drink,
      'ingredients' => $ingredients,
      'preparation' => $preparation,
      'related'     => $related
    ]);
  }

  /**
   * Método responsável por obter todos os drinks de determinada categoria
   *
   * @param integer $categoryId
   * @return array
   */
  public function drinksByCategory($categoryId){
    // SELECIONANDO DRINKS PELAS CATEGORIAS
    switch ($categoryId) {
      case '1':
        $drinks = $this->getAlcoholics(null);
        $title = 'Alcoólicos';
      break;
      case '2':
        $drinks = $this->getShaken(null);
        $title = 'Batidos';
      break;
      case '3':
        $drinks = $this->getScrambled(null);
        $title = 'Mexidos';
      break;
      case '4':
        $drinks = $this->getAssembled(null);
        $title = 'Montados';
        break;
      case '5':
        $drinks = $this->getNotAlcoholics(null);
        $title = 'Sem Álcool';
      break;
    }

    $user = AdminController::getUser();
    
    return view('drink/drinks', [
      'user'    => $user,
      'title'   => $title,
      'drinks'  => $drinks
    ]);
  }

  /**
   * Método responsável por aumentar as visualizações dos drinks
   *
   * @param object $drink
   */
  private static function newView($drink){
    $view = $drink->views + 1;
    return $drink->update(["views" => $view]);
  }

  /**
   * Método responsável por obter os drinks mais procurados
   *
   * @param integer $limit
   * @return array
   */
  private static function getMostWanted($limit){
    return Drink::orderBy('views', 'desc')->take($limit)->get();
  }
 
  /**
   * Método responsável por obter drinks alcoólicos
   *
   * @param integer $limit
   * @return array
   */
  private static function getAlcoholics($limit){
    return Drink::whereHas('categories', function ($query) {
      $query->where('categories.id', '1');
    })->orderBy('views', 'desc')->take($limit)->get();
  }

  /**
   * Método responsável por obter drinks sem álcool
   *
   * @param integer $limit
   * @return array
   */
  private static function getNotAlcoholics($limit){
    return Drink::whereHas('categories', function ($query) {
      $query->where('categories.id', '5');
    })->orderBy('views', 'desc')->take($limit)->get();
  }

  /**
   * Método responsável por obter drinks mexidos
   *
   * @param integer $limit
   * @return array
   */
  private static function getScrambled($limit){
    return Drink::whereHas('categories', function ($query) {
      $query->where('categories.id', '3');
    })->orderBy('views', 'desc')->take($limit)->get();
  }

  /**
   * Método responsável por obter drinks montados
   *
   * @param integer $limit
   * @return array
   */
  private static function getAssembled($limit){
    return Drink::whereHas('categories', function ($query) {
      $query->where('categories.id', '4');
    })->orderBy('views', 'desc')->take($limit)->get();
  }

  /**
   * Método responsável por obter drinks batidos
   *
   * @param integer $limit
   * @return array
   */
  private static function getShaken($limit)
  {
    return Drink::whereHas('categories', function ($query) {
      $query->where('categories.id', '2');
    })->orderBy('views', 'desc')->take($limit)->get();
  }

  /**
   * Método responsável por adicionar categoria ao drink
   *
   * @param integer $category
   * @param integer $drink
   */
  private function addCategory($categoryId, $drinkId)
  {
    $drink = Drink::find($drinkId);

    return $drink->categories()->attach($categoryId);
  }

  /**
   * Método responsável por remover o drink escolhido dos drinks relacionados
   *
   * @param object $related
   * @param integer $id
   * @return array
   */
  private function removeRelatedById($related, $id)
  {
    return $related->reject(function ($drink) use ($id) {
      return $drink->id == $id;
    });
  }
}
