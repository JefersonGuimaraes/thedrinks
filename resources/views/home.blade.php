@extends('layouts/main')

@section('title', 'The Drinks')

@section('content')

@include('../inc/lgpd-message')

<h1 class="mt-5">The Drinks</h1>

<p class="mt-3">
  Aqui você encontra as melhores receitas para fazer aquele drink incrível. Não importa se você está planejando
  uma festa, desejando relaxar após um longo dia ou apenas querendo explorar novos horizontes de sabor, nosso site
  de receitas de bebidas é seu guia definitivo. De margaritas a martinis, de smoothies a shots, estamos aqui para
  tornar suas experiências de degustação verdadeiramente inesquecíveis.
</p>

<div class="divisor"></div>

@if($search)
  <section class="categories" id="search">
    <h2>Buscado por: {{$search}}</h2>
    <div class="row mt-5 mb-5">
      @foreach($results as $drink)
      <div class="col-md-6 col-lg-3 mb-4">
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

<div class="divisor"></div>
@endif

<section class="categories" id="mostWanted">
  <h2>Drinks mais procurados</h2>
  <div class="row mt-5 mb-5">
    @foreach($mostWanted as $drink)
    <div class="col-md-6 col-lg-3 mb-4">
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

<div class="divisor"></div>

<section class="categories" id="alcoholics">
  <h2>Alcoólicos</h2>
  <div class="row mt-5 mb-5 align-items-stretch">
    @foreach($alcoholics as $drink)
    <div class="col-md-6 col-lg-3 mb-4">
      <a href="/drink/{{$drink->id}}" class="linkDrink">
        <div class="card">
          <img src="/images/drinks/{{$drink->photo}}" class="card-img-top" alt="{{$drink->name}}">
          <div class="card-body">
            <h3 class="card-title">{{$drink->name}}</h3>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
  <div class="d-flex">
    <a href="/drinks/1" class="mx-auto seeMore">Ver mais <i class="fa-solid fa-caret-down"></i></a>
  </div>
</section>

<div class="divisor"></div>

<section class="categories" id="notAlcoholics">
  <h2>Sem Álcool</h2>
  <div class="row mt-5 mb-5">
    @foreach($notAlcoholics as $drink)
    <div class="col-md-6 col-lg-3 mb-4">
      <a href="/drink/{{$drink->id}}" class="linkDrink">
        <div class="card">
          <img src="/images/drinks/{{$drink->photo}}" class="card-img-top" alt="{{$drink->name}}">
          <div class="card-body">
            <h3 class="card-title">{{$drink->name}}</h3>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
  <div class="d-flex">
    <a href="/drinks/5" class="mx-auto seeMore">Ver mais <i class="fa-solid fa-caret-down"></i></a>
  </div>
</section>

<div class="divisor"></div>

<section class="categories" id="scrambled">
  <h2>Mexidos</h2>
  <div class="row mt-5 mb-5">
    @foreach($scrambled as $drink)
    <div class="col-md-6 col-lg-3 mb-4">
      <a href="/drink/{{$drink->id}}" class="linkDrink">
        <div class="card">
          <img src="/images/drinks/{{$drink->photo}}" class="card-img-top" alt="{{$drink->name}}">
          <div class="card-body">
            <h3 class="card-title">{{$drink->name}}</h3>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
  <div class="d-flex">
    <a href="/drinks/3" class="mx-auto seeMore">Ver mais <i class="fa-solid fa-caret-down"></i></a>
  </div>
</section>

<div class="divisor"></div>

<section class="categories" id="assembled">
  <h2>Montados</h2>
  <div class="row mt-5 mb-5">
    @foreach($assembled as $drink)
    <div class="col-md-6 col-lg-3 mb-4">
      <a href="/drink/{{$drink->id}}" class="linkDrink">
        <div class="card">
          <img src="/images/drinks/{{$drink->photo}}" class="card-img-top" alt="{{$drink->name}}">
          <div class="card-body">
            <h3 class="card-title">{{$drink->name}}</h3>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
  <div class="d-flex">
    <a href="/drinks/4" class="mx-auto seeMore">Ver mais <i class="fa-solid fa-caret-down"></i></a>
  </div>
</section>

<div class="divisor"></div>

<section class="categories" id="shaken">
  <h2>Batidos</h2>
  <div class="row mt-5 mb-5">
    @foreach($shaken as $drink)
    <div class="col-md-6 col-lg-3 mb-4">
      <a href="/drink/{{$drink->id}}" class="linkDrink">
        <div class="card">
          <img src="/images/drinks/{{$drink->photo}}" class="card-img-top" alt="{{$drink->name}}">
          <div class="card-body">
            <h3 class="card-title">{{$drink->name}}</h3>
          </div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
  <div class="d-flex">
    <a href="/drinks/3" class="mx-auto seeMore">Ver mais <i class="fa-solid fa-caret-down"></i></a>
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>
<script src="/js/lgpdmessage.js"></script>
<script>
  window.onscroll = function() {
    progressBar()
  };

  function progressBar() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var scrolled = (winScroll / height) * 100;
    document.getElementById("progress-bar").style.width = scrolled + "%";
  }
</script>

@endsection