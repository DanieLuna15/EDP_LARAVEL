<div class="osahan-menu-fotter fixed-bottom bg-info text-center m-3 shadow rounded py-2">
    <div class="row m-0">
        <a href="{{ route('preventista.home') }}"
            class="small col text-decoration-none p-2 {{ Route::currentRouteName() == 'preventista.home' ? 'selected' : 'text-white' }}">
            <p class="h5 m-0"><i class="icofont-home"></i></p>
            Inicio
        </a>
        <a href="{{ url('/preventista/entrega') }}"
            class="small col text-decoration-none p-2 {{ Request::is('preventista/entrega') ? 'selected' : 'text-white' }}">
            <p class="h5 m-0"><i class="icofont-fast-delivery"></i></p>
            Entregas
        </a>
        <a href="{{ url('/preventista/caja') }}"
            class="small col text-decoration-none p-2 {{ Request::is('preventista/caja') ? 'selected' : 'text-white' }}">
            <p class="h5 m-0"><i class="icofont-money"></i></p>
            Caja
        </a>
        <a href="{{ url('preventista/auth/login') }}" class="text-white col small text-decoration-none p-2">
            <p class="h5 m-0"><i class="icofont-logout"></i></p>
            Salir
        </a>
    </div>
</div>
