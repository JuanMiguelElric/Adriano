<x-app-layout>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard do Administrador</h1>

        <!-- Conteúdo específico -->
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Usuário</th>
                    <th class="px-4 py-2">Tipo</th>
                    <th class="px-4 py-2">Valor</th>
                    <th class="px-4 py-2">Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $t)
                    <tr>
                        <td class="border px-4 py-2">{{ $t->id }}</td>
                        <td class="border px-4 py-2">{{ $t->wallet->user->name }}</td>
                        <td class="border px-4 py-2">{{ ucfirst($t->type) }}</td>
                        <td class="border px-4 py-2">R$ {{ number_format($t->amount, 2, ',', '.') }}</td>
                        <td class="border px-4 py-2">{{ $t->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
