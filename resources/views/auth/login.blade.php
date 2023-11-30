@extends('../layouts/main-admin')

@section('title', 'Login | The Drink')

@section('content')

    <h1 class="text-center mt-5"><strong>Admin</strong> | The Drinks</h1>

    <div id="content" class="mt-5">

        <form method="POST" action="/login">
            @csrf           

            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required/>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" aria-describedby="button-revel" required />
                    <div class="input-group-append">
                        <span class="input-group-text btn" id="button-revel" style="border-radius: 0 5px 5px 0; "><i id="icon-eye" class="fa-solid fa-eye"></i></span>
                    </div>
                </div>
                <div class="d-md-flex justify-content-between" id="group-actions">
                    <div class="mt-2">
                        <label for="remember_me" class="flex items-center">
                            <input type="checkbox" id="remember_me" name="remember" class="form-check-input" />
                            <span class="ms-2 text-sm text-gray-600">{{ __('Manter logado') }}</span>
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="mt-2">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Esqueceu sua senha?') }}
                            </a>
                        </div>
                    @endif
                </div>

            </div>
            <div class="mt-4 mt-md-5 d-flex">
                <a href="/" class="btn btn-cdx-light"><span>Cancelar</span></a>
                <button type="submit" class="btn btn-cdx ms-auto me-0"><span>Logar</span></button>
            </div>

        </form>

    </div>

    <script>
        // FUNÇÃO EXIBE/OCULTA SENHA INPUT SENHA 
        var input = document.getElementById('password')
        var button = document.getElementById('button-revel')
        var icon = document.getElementById('icon-eye')
        button.addEventListener('click', function() {
            if (input.type == 'text') {
                input.type = 'password'
                icon.className = 'fa-solid fa-eye'
            } else {
                input.type = 'text'
                icon.className = 'fa-solid fa-eye-slash'
            }
        })
    </script>

@endsection