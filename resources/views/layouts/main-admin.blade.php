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
</head>
<body>
  @if (request()->path() != 'login')
  <header>
    <nav class="navbar navbar-expand bg-light">
      <div class="container-fluid ps-lg-5 pe-lg-5">
        <a href="/">
          <img src="/images/logo-big-icon-transparent-500.png" alt="The Drinks" />
        </a>
        <ul class="navbar-nav ms-auto me-2 mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link">
              @php 
                $name = explode(' ',$user->name);
                echo "Olá, $name[0]";
              @endphp
            </a>
          </li>
          <li class="nav-item">
            <form action="/logout" method="POST">
              @csrf
              <a href="/logout" class="nav-link" 
                onclick="event.preventDefault(); 
                this.closest('form').submit()"
              >Sair</a>
            </form>
          </li>
        </ul>
      </div>
    </nav>

    <div id="progress-container">
      <div id="progress-bar-container">
        <div id="progress-bar"></div>
      </div> 
    </div>

  </header>
  @endif
  @include('../inc/alerts')
  <main>
    <div class="container-fluid main-container">
    @yield('content')

    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>