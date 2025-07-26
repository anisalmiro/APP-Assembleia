@extends('layouts.app')

@section('title', 'Membros - Sistema de Gesta&atilde;o da Igreja')
@section('page-title', 'Gestão de Membros')

@section('page-actions')
    <a href="{{ route('members.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>
        Novo Membro
    </a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-users me-2"></i>
            Lista de Membros
        </h6>
    </div>
    <div class="card-body">
        @if($members->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Estado Civil</th>
                            <th>Data de Ingresso</th>
                            <th>Família</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-2">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>
                                            <strong>{{ $member->full_name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ ucfirst($member->gender) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->phone_number }}</td>
                                <td>
                                    <span class="badge bg-{{ $member->marital_status === 'casado' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($member->marital_status) }}
                                    </span>
                                </td>
                                <td>{{ $member->date_joined->format('d/m/Y') }}</td>
                                <td>
                                    @if($member->spouse)
                                        <small class="text-success">
                                            <i class="fas fa-heart me-1"></i>
                                            Esposa: {{ $member->spouse->full_name }}
                                        </small>
                                        <br>
                                    @endif
                                    @if($member->children->count() > 0)
                                        <small class="text-info">
                                            <i class="fas fa-child me-1"></i>
                                            {{ $member->children->count() }} filho(s)
                                        </small>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('members.show', $member) }}" class="btn btn-info btn-sm" title="Visualizar">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('members.edit', $member) }}" class="btn btn-warning btn-sm" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este membro?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginação -->
            <div class="d-flex justify-content-center">
                {{ $members->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Nenhum membro cadastrado</h5>
                <p class="text-muted">Comece adicionando o primeiro membro da igreja.</p>
                <a href="{{ route('members.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>
                    Adicionar Primeiro Membro
                </a>
            </div>
        @endif
    </div>
</div>

<style>
.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 16px;
}

.table-hover tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.05);
}

.btn-group .btn {
    margin-right: 2px;
}
</style>
@endsection

