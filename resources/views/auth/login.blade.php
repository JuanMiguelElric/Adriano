<x-guest-layout>
    <!-- Mensagem de Sessão (Status) -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg border" 
         style="border-color: #C9A646;">
        <div class="text-center mb-6">

            <h2 class="text-2xl font-bold" 
                style="color: #0A3D62;">
                Acesse sua conta
            </h2>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Endereço de Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('E-mail')" 
                    class="font-semibold" 
                    style="color: #0A3D62;" />
                <x-text-input 
                    id="email" 
                    class="block mt-1 w-full border rounded-md shadow-sm" 
                    style="border-color:#BDC3C7;"
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    placeholder="Digite seu e-mail"
                    required 
                    autofocus 
                    autocomplete="username" 
                />
                <x-input-error :messages="$errors->get('email')" 
                    class="mt-1 text-sm" 
                    style="color:#C0392B;" />
            </div>

            <!-- Senha -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Senha')" 
                    class="font-semibold" 
                    style="color: #0A3D62;" />
                <x-text-input 
                    id="password" 
                    class="block mt-1 w-full border rounded-md shadow-sm" 
                    style="border-color:#BDC3C7;"
                    type="password" 
                    name="password" 
                    placeholder="Digite sua senha"
                    required 
                    autocomplete="current-password" 
                />
                <x-input-error :messages="$errors->get('password')" 
                    class="mt-1 text-sm" 
                    style="color:#C0392B;" />
            </div>

            <!-- Lembrar-me -->
            <div class="flex items-center mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input 
                        id="remember_me" 
                        type="checkbox" 
                        class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span class="ml-2 text-sm" style="color: #0A3D62;">Lembrar de mim</span>
                </label>
            </div>

            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="text-sm" 
                       href="{{ route('password.request') }}" 
                       style="color:#0A3D62;">
                        Esqueceu sua senha?
                    </a>
                @endif

                <x-primary-button 
                    class="px-5 py-2 rounded-md" 
                    style="background-color:#C9A646; color:#fff; border:none;">
                    Entrar
                </x-primary-button>
            </div>

            <div class="text-center mt-6">
                <p class="text-sm" style="color:#7f8c8d;">
                    Não tem uma conta?
                    <a href="{{ route('register') }}" 
                       style="color:#C9A646; font-weight:bold;">
                        Cadastre-se aqui
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
