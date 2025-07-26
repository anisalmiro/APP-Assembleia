@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes da Transação</h1>

    <p><strong>Membro:</strong> {{ $financialTransaction->member?->first_name ?? '---' }}</p>
    <p><strong>Tipo:</strong> {{ ucfirst($financialTransaction->type) }}</p>
    <p><strong>Valor:</strong> {{ number_format($financialTransaction->amount, 2) }} MZN</p>
    <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($financialTransaction->transaction_date)->format('d/m/Y') }}</p>
    <p><strong>Notas:</strong> {{ $financialTransaction->notes ?? '---' }}</p>

    <a href="{{ route('financial-transactions.edit', $financialTransaction) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('financial-transactions.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
