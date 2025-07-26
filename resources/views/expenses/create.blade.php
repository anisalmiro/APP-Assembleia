@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar Nova Despesa</h2>

    <form action="{{ route('expenses.store') }}" method="POST">
        @csrf

        @include('expenses.partials.form', ['expense' => null])

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
