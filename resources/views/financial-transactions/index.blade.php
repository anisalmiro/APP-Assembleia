@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Transações Financeiras</h1>
    <a href="{{ route('financial-transactions.create') }}" class="btn btn-primary mb-3">Nova Transação</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Membro</th>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transaction)
        <tr>
            <td>{{ $transaction->member?->first_name ?? '---' }}</td>
            <td>{{ ucfirst($transaction->type) }}</td>
            <td>{{ number_format($transaction->amount, 2) }} MZN</td>
            <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('financial-transactions.show', $transaction) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('financial-transactions.edit', $transaction) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('financial-transactions.destroy', $transaction) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {{ $transactions->links() }}
</div>
@endsection
