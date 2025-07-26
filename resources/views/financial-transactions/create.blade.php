@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar Nova Transação</h1>
    @include('financial-transactions._form', ['route' => route('financial-transactions.store'), 'method' => 'POST'])
</div>
@endsection
