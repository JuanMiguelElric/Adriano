<div class="flex h-screen bg-gray-100 dark:bg-gray-900">
    <!-- Sidebar -->
    <div class="w-64 bg-blue-900 text-white flex flex-col">
        <div class="p-4 text-center border-b border-blue-700">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto h-12 mb-2">
            <h2 class="text-lg font-bold">Dashboard</h2>
        </div>

        <div class="flex-1 p-4 space-y-2">
            @if(Auth::user()->role == 1)
                <!--  MENU ADMIN -->
                <a href="#" class="block px-4 py-2 rounded hover:bg-blue-700">🏠 Início</a>
  
            @else
                <!--  MENU CLIENTE -->
                    <ul class="nav flex-column">
                            <li class="nav-item mb-2">
                                <a class="nav-link active text-dark fw-bold" href="#">💰 Minhas Transações</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link text-dark" href="#">⚙️ Configurações</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-warning w-100 fw-bold">Sair</button>
                                </form>
                            </li>
                    </ul>
            @endif
        </div>

        <!-- Logout -->
        <div class="p-4 border-t border-blue-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-4 py-2 rounded bg-yellow-600 hover:bg-yellow-500">
                    🚪 Sair
                </button>
            </form>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="flex-1 p-6">
        {{ $slot }}
    </div>
</div>
