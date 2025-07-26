@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalhes da Despesa</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Descrição:</strong> {{ $expense->description }}</p>
            <p><strong>Valor:</strong> {{ number_format($expense->amount, 2, ',', '.') }} MZN</p>
            <p><strong>Categoria:</strong> {{ $expense->category }}</p>
            <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}</p>
            <p><strong>Notas:</strong> {{ $expense->notes ?? '-' }}</p>
        </div>
    </div>

    <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-warning mt-3">Editar</a>
    <a href="{{ route('expenses.index') }}" class="btn btn-secondary mt-3">Voltar</a>
</div>
@endsection
