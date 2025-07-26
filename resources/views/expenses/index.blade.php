@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Despesas</h2>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('expenses.create') }}" class="btn btn-primary mb-3">Nova Despesa</a>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Categoria</th>
            <th>Data</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($expenses as $expense)
        <tr>
            <td>{{ $expense->description }}</td>
            <td>{{ number_format($expense->amount, 2, ',', '.') }} MZN</td>
            <td>{{ $expense->category }}</td>
            <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('expenses.show', $expense) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('expenses.destroy', $expense) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {{ $expenses->links() }}
</div>
@endsection
