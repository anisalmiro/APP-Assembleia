@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalhes do Bem Patrimonial</h1>

    <p><strong>Nome:</strong> {{ $asset->name }}</p>
    <p><strong>Descrição:</strong> {{ $asset->description ?? '---' }}</p>
    <p><strong>Quantidade:</strong> {{ $asset->quantity }}</p>
    <p><strong>Data de Aquisição:</strong> {{ \Carbon\Carbon::parse($asset->acquisition_date)->format('d/m/Y') }}</p>
    <p><strong>Valor:</strong> {{ number_format($asset->value, 2) }} MZN</p>
    <p><strong>Status:</strong> {{ ucfirst($asset->status) }}</p>

    <a href="{{ route('assets.edit', $asset) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('assets.index') }}" class="btn btn-secondary">Voltar</a>
</div>
@endsection
