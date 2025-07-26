@extends('layouts.app')

@section('title', 'Novo Membro')
@section('page-title', 'Registar Novo Membro')

@section('page-actions')
    <a href="{{ route('members.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>
        Voltar
    </a>
@endsection

@section('content')
<form action="{{ route('members.store') }}" method="POST">
    @csrf

    <!-- Informações Pessoais -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-user me-2"></i>
                Informações Pessoais
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">Primeiro Nome *</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                           id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Sobrenome *</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                           id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="date_of_birth" class="form-label">Data de Nascimento *</label>
                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                           id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                    @error('date_of_birth')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="gender" class="form-label">Gênero *</label>
                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                        <option value="">Selecione...</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Masculino</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Feminino</option>
                        <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Outro</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="marital_status" class="form-label">Estado Civil *</label>
                    <select class="form-select @error('marital_status') is-invalid @enderror"
                            id="marital_status" name="marital_status" required onchange="toggleSpouseFields()">
                        <option value="">Selecione...</option>
                        <option value="single" {{ old('marital_status') === 'solteiro' ? 'selected' : '' }}>Solteiro(a)</option>
                        <option value="married" {{ old('marital_status') === 'casado' ? 'selected' : '' }}>Casado(a)</option>
                        <option value="divorced" {{ old('marital_status') === 'divorciado' ? 'selected' : '' }}>Divorciado(a)</option>
                        <option value="widowed" {{ old('marital_status') === 'viuvo' ? 'selected' : '' }}>Viúvo(a)</option>
                    </select>
                    @error('marital_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="phone_number" class="form-label">Telefone *</label>
                    <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                           id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                    @error('phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="address" class="form-label">Endereço *</label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                              id="address" name="address" rows="2" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="date_joined" class="form-label">Data de Ingresso *</label>
                    <input type="date" class="form-control @error('date_joined') is-invalid @enderror"
                           id="date_joined" name="date_joined" value="{{ old('date_joined', date('Y-m-d')) }}" required>
                    @error('date_joined')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Observações</label>
                <textarea class="form-control @error('notes') is-invalid @enderror"
                          id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Informações da Esposa -->
    <div class="card shadow mb-4" id="spouse-section" style="display: none;">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-heart me-2"></i>
                Informações da Esposa
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="spouse_first_name" class="form-label">Primeiro Nome</label>
                    <input type="text" class="form-control @error('spouse_first_name') is-invalid @enderror"
                           id="spouse_first_name" name="spouse_first_name" value="{{ old('spouse_first_name') }}">
                    @error('spouse_first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="spouse_last_name" class="form-label">Sobrenome</label>
                    <input type="text" class="form-control @error('spouse_last_name') is-invalid @enderror"
                           id="spouse_last_name" name="spouse_last_name" value="{{ old('spouse_last_name') }}">
                    @error('spouse_last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="spouse_date_of_birth" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control @error('spouse_date_of_birth') is-invalid @enderror"
                           id="spouse_date_of_birth" name="spouse_date_of_birth" value="{{ old('spouse_date_of_birth') }}">
                    @error('spouse_date_of_birth')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="spouse_phone_number" class="form-label">Telefone</label>
                    <input type="tel" class="form-control @error('spouse_phone_number') is-invalid @enderror"
                           id="spouse_phone_number" name="spouse_phone_number" value="{{ old('spouse_phone_number') }}">
                    @error('spouse_phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="spouse_email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('spouse_email') is-invalid @enderror"
                           id="spouse_email" name="spouse_email" value="{{ old('spouse_email') }}">
                    @error('spouse_email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Informações dos Filhos -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-child me-2"></i>
                Informações dos Filhos
            </h6>
            <button type="button" class="btn btn-success btn-sm" onclick="addChild()">
                <i class="fas fa-plus me-1"></i>
                Adicionar Filho
            </button>
        </div>
        <div class="card-body">
            <div id="children-container">
                <p class="text-muted">Clique em "Adicionar Filho" para incluir informações dos filhos.</p>
            </div>
        </div>
    </div>

    <!-- Botões de Ação -->
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('members.index') }}" class="btn btn-secondary">
            <i class="fas fa-times me-1"></i>
            Cancelar
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i>
            Salvar Membro
        </button>
    </div>
</form>
@endsection

@section('scripts')
<script>
let childCount = 0;

function toggleSpouseFields() {
    const maritalStatus = document.getElementById('marital_status').value;
    const spouseSection = document.getElementById('spouse-section');

    if (maritalStatus === 'married') {
        spouseSection.style.display = 'block';
    } else {
        spouseSection.style.display = 'none';
    }
}

function addChild() {
    childCount++;
    const container = document.getElementById('children-container');

    if (childCount === 1) {
        container.innerHTML = '';
    }

    const childHtml = `
        <div class="child-item border rounded p-3 mb-3" id="child-${childCount}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Filho ${childCount}</h6>
                <button type="button" class="btn btn-danger btn-sm" onclick="removeChild(${childCount})">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Primeiro Nome *</label>
                    <input type="text" class="form-control" name="children[${childCount}][first_name]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Sobrenome *</label>
                    <input type="text" class="form-control" name="children[${childCount}][last_name]" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Data de Nascimento *</label>
                    <input type="date" class="form-control" name="children[${childCount}][date_of_birth]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gênero *</label>
                    <select class="form-select" name="children[${childCount}][gender]" required>
                        <option value="">Selecione...</option>
                        <option value="male">Masculino</option>
                        <option value="female">Feminino</option>
                        <option value="other">Outro</option>
                    </select>
                </div>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', childHtml);
}

function removeChild(childId) {
    const childElement = document.getElementById(`child-${childId}`);
    childElement.remove();

    const container = document.getElementById('children-container');
    if (container.children.length === 0) {
        container.innerHTML = '<p class="text-muted">Clique em "Adicionar Filho" para incluir informações dos filhos.</p>';
    }
}

// Verificar se deve mostrar seção da esposa ao carregar a página
document.addEventListener('DOMContentLoaded', function() {
    toggleSpouseFields();
});
</script>
@endsection

