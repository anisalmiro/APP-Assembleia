@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Despesa</h2>

    <form action="{{ route('expenses.update', $expense) }}" method="POST">
        @csrf
        @method('PUT')

        @include('expenses.partials.form', ['expense' => $expense])

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('expenses.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
