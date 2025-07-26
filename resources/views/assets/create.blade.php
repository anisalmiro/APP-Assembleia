@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Bem Patrimonial</h1>
    @include('assets._form', [
    'route' => route('assets.store'),
    'method' => 'POST',
    'asset' => null
    ])
</div>
@endsection
