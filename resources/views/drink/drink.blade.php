@extends('../layouts/main')

@section('title', 'Drink | The Drink')

@section('content')
<div class="row mt-5 pb-3">
  <div class="col-lg-5 d-flex">
    <div class="mx-auto">
      <img src="/images/drinks/{{$drink->photo}}" alt="{{$drink->name}}" class="mx-auto my-auto img-fluid" style="border-radius: 20px; max-height: 600px">
      <p class="text-end mt-4" style="color: #DCDC; font-size: .875em">Visualizações: {{$drink->views}}</p>
    </div>
  </div>
  <div class="col-lg-7 ps-lg-3">
    <h1 class="text-center mt-4 mt-lg-0">{{$drink->name}}</h1>
    <div class="row">
      <div class="col-md-6">
        <h2 class="fs-4 mt-5">Categorias:</h2>
        <ul>
          @foreach($drink->categories as $category)
          <li>{{$category->category}}</li>
          @endforeach
        </ul>
      </div>
      <div class="col-md-6">
        <h2 class="fs-4 mt-5">Ingredientes:</h2>
        <ul class="mt-3">
          @foreach($ingredients as $ingredient)
            @if($ingredient != null)
            <li class="mt-2">{{$ingredient}}</li>
            @endif
          @endforeach
        </ul>
      </div>
    </div>
    <h2 class="fs-4 mt-5">Modo de preparo:</h2>
    <ol class="mt-3">
      @foreach($preparation as $step)
        @if($step != null)
        <li class="mt-2">{{$step}}</li>
        @endif
      @endforeach
    </ol>
  </div>
</div>
<div class="divisor"></div>    
<section class="categories" id="related">
  <h2>Drinks que pode gostar</h2>
  <div class="row mt-5 mb-5">
    @foreach($related as $drink)
      <div class="col-md-3 col-lg-4 mb-4">
        <a href="/drink/{{$drink->id}}" class="linkDrink">
          <div class=" card">
            <img src="/images/drinks/{{$drink->photo}}" class="card-img-top" alt="{{$drink->photo}}">
            <div class="card-body">
              <h3 class="card-title">{{$drink->name}}</h3>
            </div>
          </div>
        </a>
      </div>
    @endforeach
  </div>
</section>
    
@endsection