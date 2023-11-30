@if(session('success'))
    <div class="d-flex alert-container mt-3">

        <div class="alert-content mx-auto">

            <p class="alert-text">
                {{ session('success') }}
            </p>

            <div class="alert-bar" style="background-color: #38B6FF;"></div>
        </div>

    </div>
    @php 
        session()->forget('success');
    @endphp
@endif

@if ($errors->any())
    <div class="d-flex alert-container mt-3">

        <div class="alert-content alert-error mx-auto">

            <p class="alert-text ps-3 pe-3">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </p>

            <div class="alert-bar" style="background-color: #F009;"></div>
        </div>

    </div>
@endif

@if (session('error'))
    <div class="d-flex alert-container mt-3">

        <div class="alert-content alert-error mx-auto">

            <p class="alert-text ps-3 pe-3">
                {{ session('error') }}
            </p>

            <div class="alert-bar" style="background-color: #F009;"></div>
        </div>

    </div>
@endif

<script>
    //FUNÇÃO FADEOUT DOS ALERTS
    setTimeout(() => {
        $('.alert-content').fadeOut('slow')
    }, 3000);
</script>