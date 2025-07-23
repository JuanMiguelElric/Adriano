<x-app-layout>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Cliente -->
        <div class="col-md-3 bg-light p-3 border-end">
            <h4 class="mb-4 text-primary">Minha Conta</h4>
           
        </div>

        <!-- Conteúdo Principal -->
        <div class="col-md-9 p-4">
            <!-- Card de Boas-Vindas -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-2">Bem-vindo, <strong>{{ Auth::user()->name }}</strong></h5>
                    <h4 class="text-success">
                        Saldo Atual: 
                        <span class="fw-bold">
                            R$ {{ number_format(optional($wallet)->balance ?? 0, 2, ',', '.') }}
                        </span>
                    </h4>
                </div>
            </div>

            <!-- Card de Ações -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white fw-bold">
                    Ações Rápidas
                </div>
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <button class="btn btn-success flex-fill" data-bs-toggle="modal" data-bs-target="#depositModal">
                            ➕ Depositar
                        </button>
                        <button class="btn btn-warning flex-fill" data-bs-toggle="modal" data-bs-target="#withdrawModal">
                            ➖ Sacar
                        </button>
                        <button class="btn btn-primary flex-fill" data-bs-toggle="modal" data-bs-target="#transferModal">
                            🔄 Transferir
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card de Últimas Transações -->
            <div class="card shadow-sm">
                <div class="card-header bg-light fw-bold">
                    Últimas Transações
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Descrição</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $t)
                                <tr>
                                    <td>{{ $t->id }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($t->type == 'deposit') bg-success 
                                            @elseif($t->type == 'withdraw') bg-warning
                                            @elseif($t->type == 'transfer') bg-primary
                                            @else bg-secondary
                                            @endif">
                                            {{ ucfirst($t->type) }}
                                        </span>
                                    </td>
                                    <td class="fw-bold text-dark">
                                        R$ {{ number_format($t->amount, 2, ',', '.') }}
                                    </td>
                                    <td>{{ $t->description }}</td>
                                    <td class="text-muted">
                                        {{ $t->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        Nenhuma transação encontrada.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
