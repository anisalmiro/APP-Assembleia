<form action="{{ $route }}" method="POST">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <div class="mb-3">
        <label>Nome</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $asset->name ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Descrição</label>
        <textarea name="description" class="form-control">{{ old('description', $asset->description ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label>Quantidade</label>
        <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $asset->quantity ?? 1) }}" required>
    </div>

    <div class="mb-3">
        <label>Data de Aquisição</label>
        <input type="date" name="acquisition_date" class="form-control"
               value="{{ old('acquisition_date', isset($asset) ? \Carbon\Carbon::parse($asset->acquisition_date)->format('Y-m-d') : '') }}" required>
    </div>

    <div class="mb-3">
        <label>Valor (MZN)</label>
        <input type="number" step="0.01" name="value" class="form-control" value="{{ old('value', $asset->value ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            @foreach(['new' => 'Novo', 'good' => 'Bom', 'damaged' => 'Danificado', 'discarded' => 'Descartado'] as $key => $label)
            <option value="{{ $key }}" {{ old('status', $asset->status ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
</form>
