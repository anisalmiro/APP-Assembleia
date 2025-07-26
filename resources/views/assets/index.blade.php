@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Bens Patrimoniais</h1>

    <a href="{{ route('assets.create') }}" class="btn btn-primary mb-3">Adicionar Bem</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Data de Aquisição</th>
            <th>Valor (MZN)</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($assets as $asset)
        <tr>
            <td>{{ $asset->name }}</td>
            <td>{{ $asset->quantity }}</td>
            <td>{{ \Carbon\Carbon::parse($asset->acquisition_date)->format('d/m/Y') }}</td>
            <td>{{ number_format($asset->value, 2) }}</td>
            <td>{{ ucfirst($asset->status) }}</td>
            <td>
                <a href="{{ route('assets.show', $asset) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('assets.edit', $asset) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('assets.destroy', $asset) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmar exclusão?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {{ $assets->links() }}
</div>
@endsection
