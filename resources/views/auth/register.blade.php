<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Crie sua conta</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nome -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Nome')" />
                <x-text-input 
                    id="name" 
                    class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    placeholder="Digite seu nome completo"
                    required 
                    autofocus 
                    autocomplete="name" 
                />
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- E-mail -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('E-mail')" />
                <x-text-input 
                    id="email" 
                    class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    placeholder="Digite seu melhor e-mail"
                    required 
                    autocomplete="username" 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Senha -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Senha')" />
                <x-text-input 
                    id="password" 
                    class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                    type="password" 
                    name="password" 
                    placeholder="Digite uma senha segura"
                    required 
                    autocomplete="new-password" 
                />
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-500" />
            </div>

            <!-- Confirmar Senha -->
            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Confirme a Senha')" />
                <x-text-input 
                    id="password_confirmation" 
                    class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                    type="password" 
                    name="password_confirmation" 
                    placeholder="Repita sua senha"
                    required 
                    autocomplete="new-password" 
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-500" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="text-sm text-indigo-600 hover:text-indigo-800" href="{{ route('login') }}">
                    Já tem uma conta? Faça login
                </a>

                <x-primary-button class="px-5 py-2 rounded-md bg-indigo-600 hover:bg-indigo-700 text-white">
                    Cadastrar
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
