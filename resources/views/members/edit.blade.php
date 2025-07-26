@extends('layouts.app')

@section('title', 'Editar Membro')
@section('page-title', 'Editar Membro')

@section('page-actions')
<a href="{{ route('members.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left me-1"></i> Voltar
</a>
@endsection

@section('content')
<form action="{{ route('members.update', $member) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Bloco de Informações Pessoais (mesma estrutura) -->
    <!-- Abaixo estão exemplos de como alterar o preenchimento dos campos -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-user me-2"></i> Informações Pessoais
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="first_name" class="form-label">Primeiro Nome *</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                           id="first_name" name="first_name"
                           value="{{ old('first_name', $member->first_name) }}" required>
                    @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="last_name" class="form-label">Sobrenome *</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                           id="last_name" name="last_name"
                           value="{{ old('last_name', $member->last_name) }}" required>
                    @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="date_of_birth" class="form-label">Data de Nascimento *</label>
                    <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                           id="date_of_birth" name="date_of_birth"
                           value="{{ old('date_of_birth', \Carbon\Carbon::parse($member->date_of_birth)->format('Y-m-d')) }}" required>
                    @error('date_of_birth')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="gender" class="form-label">Gênero *</label>
                    <select class="form-select @error('gender') is-invalid @enderror"
                            id="gender" name="gender" required>
                        <option value="">Selecione...</option>
                        <option value="male" {{ old('gender', $member->gender) === 'male' ? 'selected' : '' }}>Masculino</option>
                        <option value="female" {{ old('gender', $member->gender) === 'female' ? 'selected' : '' }}>Feminino</option>
                        <option value="other" {{ old('gender', $member->gender) === 'other' ? 'selected' : '' }}>Outro</option>
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
                        <option value="single" {{ old('marital_status', $member->marital_status) === 'single' ? 'selected' : '' }}>Solteiro(a)</option>
                        <option value="married" {{ old('marital_status', $member->marital_status) === 'married' ? 'selected' : '' }}>Casado(a)</option>
                        <option value="divorced" {{ old('marital_status', $member->marital_status) === 'divorced' ? 'selected' : '' }}>Divorciado(a)</option>
                        <option value="widowed" {{ old('marital_status', $member->marital_status) === 'widowed' ? 'selected' : '' }}>Viúvo(a)</option>
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
                           id="phone_number" name="phone_number"
                           value="{{ old('phone_number', $member->phone_number) }}" required>
                    @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email', $member->email) }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mb-3">
                    <label for="address" class="form-label">Endereço *</label>
                    <textarea class="form-control @error('address') is-invalid @enderror"
                              id="address" name="address" rows="2" required>{{ old('address', $member->address) }}</textarea>
                    @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="date_joined" class="form-label">Data de Ingresso *</label>
                    <input type="date" class="form-control @error('date_joined') is-invalid @enderror"
                           id="date_joined" name="date_joined"
                           value="{{ old('date_joined', \Carbon\Carbon::parse($member->date_joined)->format('Y-m-d')) }}" required>
                    @error('date_joined')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Observações</label>
                <textarea class="form-control @error('notes') is-invalid @enderror"
                          id="notes" name="notes" rows="3">{{ old('notes', $member->notes) }}</textarea>
                @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Resto das seções: esposa, filhos, etc. -->
    <!-- Reaproveite o mesmo código de criação, mas use os valores de $member->spouse e $member->children, se desejado -->

    <!-- Botões -->
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('members.index') }}" class="btn btn-secondary">
            <i class="fas fa-times me-1"></i> Cancelar
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save me-1"></i> Atualizar Membro
        </button>
    </div>
</form>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        toggleSpouseFields();
    });
</script>
@endsection
