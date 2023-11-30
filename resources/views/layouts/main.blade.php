<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/css/style.css">
  @if (isset($css)) <link rel="stylesheet" href="/css/{{$css}}.css"> @endif
  <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
  
  <header>
    <nav class="navbar navbar-expand-xl bg-light">
      <div class="container-fluid ps-lg-5 pe-lg-5">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars" id="iconButton"></i>
        </button>
        <a href="/">
            <img src="/images/logo-big-icon-transparent-500.png" alt="The Drinks" />
        </a>
        <form>
          <button class="navbar-toggler" id="button-search" type="button" data-bs-toggle="collapse" data-bs-target="#containerSearch" aria-controls="containerSearch" aria-expanded="false">
            <i id="iconSearch" class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
        @php
          $path = (request()->path() != '/') ? '/' : '';
        @endphp
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
              <li class="nav-item d-flex">
                  <a class="nav-link my-auto" href="{{$path}}#alcoholics">Alcoólicos</a>
              </li>
              <li class="nav-item ps-xl-4 d-flex">
                  <a class="nav-link my-auto" href="{{$path}}#notAlcoholics">Sem álcool</a>
              </li>
              <li class="nav-item ps-xl-4 d-flex">
                  <a class="nav-link my-auto" href="{{$path}}#scrambled">Mexidos</a>
              </li>
              <li class="nav-item ps-xl-4 d-flex">
                  <a class="nav-link my-auto" href="{{$path}}#assembled">Montados</a>
              </li>
              <li class="nav-item ps-xl-4 d-flex">
                  <a class="nav-link my-auto" href="{{$path}}#shaken">Batidos</a>
              </li>
          </ul>
          <form method="GET" action="/" class="d-none d-xl-flex me-3" role="search">
            <div class="input-group">
              <input class="form-control border-end-0 border rounded-pill" type="search" placeholder="Busque por drinks" id="search" name="search">
              <span class="input-group-append">
                  <button class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5" type="button" style="margin-left: -40px; margin-top: 1.7px">
                      <i class="fa fa-search"></i>
                  </button>
              </span>
            </div>
          </form>
          @auth
            <ul class="navbar-nav me-lg-4 mt-4 mt-lg-0">
              <li class="nav-item dropdown">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      @php 
                        $name = explode(' ',$user->name);
                        echo "Olá, $name[0]";
                      @endphp
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                          <a class="dropdown-item" href="/admin">Área Restrita</a>
                        </li>
                        <li>
                          <form action="/logout" method="POST">
                            @csrf
                            <a href="/logout" class="dropdown-item" 
                              onclick="event.preventDefault(); 
                              this.closest('form').submit()"
                            >Sair</a>
                          </form>
                        </li>
                    </ul>
              </li>
            </ul>
          @endauth  
          @guest
              <ul class="navbar-nav">
                  <li class="nav-item d-flex ms-lg-2">
                      <a href="/login" class="nav-link">Login</a>
                  </li>
              </ul>
          @endguest
        </div>
      </div>
    </nav>
    <div id="progress-container">
      <div id="progress-bar-container">
        <div id="progress-bar"></div>
      </div> 
    </div>

    <div class="container collapse" id="containerSearch">
      <form action="/" method="GET">
        <div class="input-group mt-3">
          <input class="form-control border-end-0 border rounded-pill" type="search" placeholder="Busque por drinks" id="input-search" name="search">
          <span class="input-group-append">
              <button class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5" type="button" style="margin-left: -40px;">
                  <i class="fa fa-search"></i>
              </button>
          </span>
        </div>
      </form>
    </div>
  </header>
  
  <div class="container-fluid">
    <div class="row">
      <aside class="col-lg-2 d-none d-lg-block">
      </aside>
        @include('../inc/alerts')
      <main class="col-12 col-lg-8">
        <div class="container-fluid">

        @yield('content')

        </div>
      </main>
      <aside class="col-lg-2 d-none d-lg-block">
      </aside>
    </div>
  </div>
  
  <footer id="index" class="bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-6 d-flex">
          <nav class="navbar mx-auto my-auto">
            <ul>
              <li class="nav-item">
                <a href="{{$path}}#alcoholics" class="nav-link">Alcoólicos</a>
              </li>
              <li class="nav-item">
                <a href="{{$path}}#notAlcoholics" class="nav-link">Sem álcool</a>
              </li>
              <li class="nav-item">
                <a href="{{$path}}#scrambled" class="nav-link">Mexidos</a>
              </li>
            </ul>
            <ul>
              <li class="nav-item">
                <a href="{{$path}}#assembled" class="nav-link">Montados</a>
              </li>
              <li class="nav-item">
                <a href="{{$path}}#shaken" class="nav-link">Batidos</a>
              </li>
            </ul>
          </nav>
        </div>
        <div class="col-md-6 d-flex">
          <a href="#" class="mx-auto my-auto">
            <img src="/images/logo-big-icon-transparent.png" class="img-fluid" width="200" height="200" alt="Receitas de drinks">
          </a>
        </div>
        <p class="text-center">Desenvolvido por <a href="https://www.codxtech.com.br" target="_blank">CODX Tech</a> &copy 2023</p>
      </div>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script>
    document.querySelector(".navbar-toggler").addEventListener('click', ()=>{
      let icon = document.querySelector("#iconButton")
      if (icon.classList[1] == 'fa-bars'){
          icon.classList.remove('fa-bars')
          icon.classList.add('fa-xmark')
      }else{
          icon.classList.remove('fa-xmark')
          icon.classList.add('fa-bars')

      }        
    })

    document.querySelector("#button-search").addEventListener('click', ()=>{
      let icon = document.querySelector("#iconSearch")
      if (icon.classList[1] == 'fa-magnifying-glass'){
          icon.classList.remove('fa-magnifying-glass')
          icon.classList.add('fa-xmark')
      }else{
          icon.classList.remove('fa-xmark')
          icon.classList.add('fa-magnifying-glass')

      }

      document.querySelector("#input-search").focus()
    })
  </script>
</body>
</html>