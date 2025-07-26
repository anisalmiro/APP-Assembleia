@extends('layouts.app')

@section('title', 'Detalhes do Membro - Ana Costa')
@section('page-title', 'Informações do Membro')

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-user me-2"></i>
            Perfil de {{ $member->first_name }} {{ $member->last_name }}
        </h6>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Dados Pessoais</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Nome:</strong> {{ $member->first_name }} {{ $member->last_name }}</li>
                    <li class="list-group-item"><strong>Gênero:</strong> {{ ucfirst($member->gender) }}</li>
                    <li class="list-group-item"><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($member->date_of_birth)->format('d/m/Y') }}</li>
                    <li class="list-group-item"><strong>Estado Civil:</strong> {{ ucfirst($member->marital_status) }}</li>
                    <li class="list-group-item"><strong>Data de Ingresso:</strong> {{ \Carbon\Carbon::parse($member->date_joined)->format('d/m/Y') }}</li>
                    <li class="list-group-item"><strong>Endereço:</strong> {{ $member->address }}</li>
                    <li class="list-group-item"><strong>Telefone:</strong> {{ $member->phone_number }}</li>
                    <li class="list-group-item"><strong>Email:</strong> {{ $member->email }}</li>
                    <li class="list-group-item"><strong>Notas:</strong> {{ $member->notes }}</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h5>Informações Familiares</h5>
                @if($member->spouse)
                <p><i class="fas fa-heart text-danger me-1"></i> Esposa: {{ $member->spouse->full_name }}</p>
                @else
                <p><i class="fas fa-heart-broken text-secondary me-1"></i> Não possui cônjuge registado.</p>
                @endif

                @if($member->children && count($member->children) > 0)
                <p><i class="fas fa-child me-1 text-info"></i> {{ count($member->children) }} filho(s) registado(s).</p>
                @else
                <p><i class="fas fa-child me-1 text-muted"></i> Nenhum filho registado.</p>
                @endif

                <h5 class="mt-4">Última Transação Financeira</h5>
                @if($member->financial_transactions && count($member->financial_transactions) > 0)
                @php
                $lastTransaction = $member->financial_transactions[0];
                @endphp
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Tipo:</strong> {{ ucfirst($lastTransaction->type) }}</li>
                    <li class="list-group-item"><strong>Valor:</strong> {{ number_format($lastTransaction->amount, 2, ',', '.') }} MZN</li>
                    <li class="list-group-item"><strong>Data:</strong> {{ \Carbon\Carbon::parse($lastTransaction->transaction_date)->format('d/m/Y') }}</li>
                    <li class="list-group-item"><strong>Nota:</strong> {{ $lastTransaction->notes }}</li>
                </ul>
                @else
                <p class="text-muted">Nenhuma transação registada.</p>
                @endif
            </div>
        </div>
        <a href="{{ route('members.index') }}" class="btn btn-secondary mt-3">
            <i class="fas fa-arrow-left me-1"></i> Voltar à lista de membros
        </a>
    </div>
</div>
@endsection
