@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Bem Patrimonial</h1>
    @include('assets._form', [
    'route' => route('assets.update', $asset),
    'method' => 'PUT',
    'asset' => $asset
    ])
</div>
@endsection
