<x-app-layout>
<div class="container-fluid">
    <div class="row">
        <!-- Conteúdo Principal -->
        <div class="col-md-9 p-4">

            <!-- ✅ ALERTAS DE SUCESSO E ERRO -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>✅ Sucesso!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>❌ Erro!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Card de Boas-Vindas -->
            <div class="card shadow-sm mb-4 border-0">
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
            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    Ações Rápidas
                </div>
                <div class="card-body">
                    <div class="d-flex gap-3">
                        <button class="btn btn-success flex-fill" data-bs-toggle="modal" data-bs-target="#depositModal">➕ Depositar</button>
                        <button class="btn btn-warning flex-fill" data-bs-toggle="modal" data-bs-target="#withdrawModal">➖ Sacar</button>
                        <button class="btn btn-primary flex-fill" data-bs-toggle="modal" data-bs-target="#transferModal">🔄 Transferir</button>
                    </div>
                </div>
            </div>

            <!-- Card de Últimas Transações -->
            <div class="card shadow-sm border-0">
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
                                    <td class="text-muted">{{ $t->created_at->format('d/m/Y H:i') }}</td>

                                         <td>
                                            @if($t->status === 'completed')
                                                <button class="btn btn-sm btn-danger"
                                                        onclick="openRefundModal({{ $t->id }})">
                                                    🔙 Reembolsar
                                                </button>
                                            @else
                                                <span class="badge bg-secondary">Já Reembolsado</span>
                                            @endif
                                        </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">Nenhuma transação encontrada.</td>
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

@include('partials.wallet-modals')
