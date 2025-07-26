@extends('layouts.app')

@section('title', 'Relatório Financeiro')
@section('page-title', 'Relatório Financeiro')

@section('content')
<div class="container">
    <h2>Transações Financeiras</h2>

    {{-- Formulário de filtros --}}
    <form method="GET" action="{{ route('reports.financial') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-3">
            <label for="transaction_date_from" class="form-label">Data Inicial</label>
            <input type="date" id="transaction_date_from" name="transaction_date_from" class="form-control" value="{{ request('transaction_date_from') }}">
        </div>
        <div class="col-md-3">
            <label for="transaction_date_to" class="form-label">Data Final</label>
            <input type="date" id="transaction_date_to" name="transaction_date_to" class="form-control" value="{{ request('transaction_date_to') }}">
        </div>
        <div class="col-md-3">
            <label for="type" class="form-label">Tipo de Doação</label>
            <select id="type" name="type" class="form-select">
                <option value="">Todos</option>
                <option value="tithe" {{ request('type') == 'tithe' ? 'selected' : '' }}>Dízimo</option>
                <option value="donation" {{ request('type') == 'donation' ? 'selected' : '' }}>Doação</option>
                <option value="collection" {{ request('type') == 'collection' ? 'selected' : '' }}>Coleta</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('reports.financial') }}" class="btn btn-secondary">Limpar</a>
        </div>
    </form>

    {{-- Botões para exportar --}}
    <div class="mb-3">
        <a href="{{ route('reports.financial.export', array_merge(request()->all(), ['format' => 'excel'])) }}" class="btn btn-success me-2">
            <i class="fas fa-file-excel"></i> Exportar Excel
        </a>
        <a href="{{ route('reports.financial.export', array_merge(request()->all(), ['format' => 'pdf'])) }}" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Exportar PDF
        </a>
    </div>

    {{-- Tabela de transações financeiras --}}
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Membro</th>
            <th>Tipo</th>
            <th>Valor (MZN)</th>
            <th>Data</th>
            <th>Observações</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @forelse($transactions as $transaction)
        <tr>
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->member ? $transaction->member->first_name . ' ' . $transaction->member->last_name : '—' }}</td>
            <td>{{ ucfirst($transaction->type) }}</td>
            <td>{{ number_format($transaction->amount, 2, ',', '.') }}</td>
            <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}</td>
            <td>{{ $transaction->notes ?? '-' }}</td>
            <td>
                <a href="{{ route('financial-transactions.show', $transaction) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('financial-transactions.edit', $transaction) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('financial-transactions.destroy', $transaction) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja remover esta transação?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center">Nenhuma transação encontrada.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $transactions->appends(request()->query())->links() }}

    <hr>

    <h2>Despesas</h2>

    {{-- Filtro para despesas --}}
    <form method="GET" action="{{ route('reports.financial') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-3">
            <label for="expense_date_from" class="form-label">Data Inicial</label>
            <input type="date" id="expense_date_from" name="expense_date_from" class="form-control" value="{{ request('expense_date_from') }}">
        </div>
        <div class="col-md-3">
            <label for="expense_date_to" class="form-label">Data Final</label>
            <input type="date" id="expense_date_to" name="expense_date_to" class="form-control" value="{{ request('expense_date_to') }}">
        </div>
        <div class="col-md-3">
            <label for="category" class="form-label">Categoria</label>
            <input type="text" id="category" name="category" class="form-control" value="{{ request('category') }}" placeholder="Categoria">
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('reports.financial') }}" class="btn btn-secondary">Limpar</a>
        </div>
    </form>

    {{-- Tabela de despesas --}}
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th>Valor (MZN)</th>
            <th>Data</th>
            <th>Observações</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @forelse($expenses as $expense)
        <tr>
            <td>{{ $expense->id }}</td>
            <td>{{ $expense->description }}</td>
            <td>{{ $expense->category }}</td>
            <td>{{ number_format($expense->amount, 2, ',', '.') }}</td>
            <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}</td>
            <td>{{ $expense->notes ?? '-' }}</td>
            <td>
                <a href="{{ route('expenses.show', $expense) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('expenses.destroy', $expense) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja remover esta despesa?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center">Nenhuma despesa encontrada.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $expenses->appends(request()->query())->links() }}
</div>
@endsection
