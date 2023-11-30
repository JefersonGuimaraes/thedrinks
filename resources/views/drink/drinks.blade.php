@extends('layouts/main')

@section('title', 'The Drinks')

@section('content')

<section class="categories" id="mostWanted">
  <h2>Drinks {{$title}}:</h2>
  <div class="row mt-5 mb-5">
    @foreach($drinks as $drink)
    <div class="col-md-3 col-lg-4 mt-4">
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