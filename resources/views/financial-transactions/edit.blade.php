@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Transação</h1>
    @include('financial-transactions._form', [
    'route' => route('financial-transactions.update', $financialTransaction),
    'method' => 'PUT',
    'transaction' => $financialTransaction
    ])
</div>
@endsection
