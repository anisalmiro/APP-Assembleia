@extends('layouts.app')

@section('title', 'Relatório de Ativos')
@section('page-title', 'Relatório de Ativos')

@section('content')
<div class="container">
    <h2>Ativos</h2>

    <form method="GET" action="{{ route('reports.assets') }}" class="mb-4 row g-3 align-items-end">
        <div class="col-md-3">
            <label for="acquisition_date_from" class="form-label">Data Aquisição (De)</label>
            <input type="date" id="acquisition_date_from" name="acquisition_date_from" class="form-control" value="{{ request('acquisition_date_from') }}">
        </div>
        <div class="col-md-3">
            <label for="acquisition_date_to" class="form-label">Data Aquisição (Até)</label>
            <input type="date" id="acquisition_date_to" name="acquisition_date_to" class="form-control" value="{{ request('acquisition_date_to') }}">
        </div>
        <div class="col-md-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select">
                <option value="">-- Todos --</option>
                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Novo</option>
                <option value="good" {{ request('status') == 'good' ? 'selected' : '' }}>Bom</option>
                <option value="damaged" {{ request('status') == 'damaged' ? 'selected' : '' }}>Danificado</option>
                <option value="discarded" {{ request('status') == 'discarded' ? 'selected' : '' }}>Descartado</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('reports.assets', request()->except('page')) }}" class="btn btn-secondary">Limpar</a>
            <a href="{{ route('reports.assets.export', array_merge(request()->all(), ['format' => 'excel'])) }}" class="btn btn-success">Exportar Excel</a>
            <a href="{{ route('reports.assets.export', array_merge(request()->all(), ['format' => 'pdf'])) }}" class="btn btn-danger">Exportar PDF</a>
        </div>
    </form>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Quantidade</th>
            <th>Data de Aquisição</th>
            <th>Valor (MZN)</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @forelse($assets as $asset)
        <tr>
            <td>{{ $asset->name }}</td>
            <td>{{ $asset->description ?? '-' }}</td>
            <td>{{ $asset->quantity }}</td>
            <td>{{ \Carbon\Carbon::parse($asset->acquisition_date)->format('d/m/Y') }}</td>
            <td>{{ number_format($asset->value, 2, ',', '.') }}</td>
            <td>{{ ucfirst($asset->status) }}</td>
            <td>
                <a href="{{ route('assets.show', $asset) }}" class="btn btn-sm btn-info">Ver</a>
                <a href="{{ route('assets.edit', $asset) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('assets.destroy', $asset) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja remover este ativo?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Excluir</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Nenhum ativo encontrado.</td>
        </tr>
        @endforelse
        </tbody>
    </table>

    {{ $assets->appends(request()->query())->links() }}
</div>
@endsection
