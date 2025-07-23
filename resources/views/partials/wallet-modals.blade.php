<!-- resources/views/partials/wallet-modals.blade.php -->

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
<!-- Modal Reembolso -->
<div class="modal fade" id="refundModal" tabindex="-1" aria-labelledby="refundModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="refundModalLabel">🔙 Solicitar Reembolso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('wallet.refund') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="transaction_id" id="refundTransactionId">
                    <div class="mb-3">
                        <label for="refundReason" class="form-label">Motivo do Reembolso</label>
                        <textarea class="form-control" id="refundReason" name="reason" rows="3" placeholder="Descreva o motivo do reembolso (opcional)"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Confirmar Reembolso</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Preenche o ID da transação no modal antes de abrir
    function openRefundModal(transactionId) {
        document.getElementById('refundTransactionId').value = transactionId;
        new bootstrap.Modal(document.getElementById('refundModal')).show();
    }
</script>

<!-- Modal Depositar -->
<div class="modal fade" id="depositModal" tabindex="-1" aria-labelledby="depositModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">💰 Depositar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('wallet.deposit') }}">
                @csrf
                <div class="modal-body">
                    <label class="form-label">Valor</label>
                    <input type="number" step="0.01" class="form-control mb-3" name="amount" required>

                    <label class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="description" placeholder="Ex: Depósito inicial" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Sacar -->
<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">➖ Sacar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('wallet.withdraw') }}">
                @csrf
                <div class="modal-body">
                    <label class="form-label">Valor</label>
                    <input type="number" step="0.01" class="form-control mb-3" name="amount" required>

                    <label class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="description" placeholder="Ex: Pagamento de serviço" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Transferir -->
<div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">🔄 Transferir</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('wallet.transfer') }}">
                @csrf
                <div class="modal-body">
                    <label class="form-label">Destinatário</label>
                    <input type="text" class="form-control mb-3" name="recipient" placeholder="E-mail ou ID" required>

                    <label class="form-label">Valor</label>
                    <input type="number" step="0.01" class="form-control mb-3" name="amount" required>

                    <label class="form-label">Descrição</label>
                    <input type="text" class="form-control" name="description" placeholder="Ex: Pagamento amigo" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
