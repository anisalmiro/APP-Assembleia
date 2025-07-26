<div class="mb-3">
    <label for="description" class="form-label">Descrição</label>
    <input type="text" name="description" id="description" class="form-control" value="{{ old('description', optional($expense)->description) }}" required>
</div>

<div class="mb-3">
    <label for="amount" class="form-label">Valor (MZN)</label>
    <input type="number" name="amount" id="amount" class="form-control" value="{{ old('amount', optional($expense)->amount) }}" step="0.01" required>
</div>

<div class="mb-3">
    <label for="expense_date" class="form-label">Data da Despesa</label>
    <input type="date" name="expense_date" id="expense_date" class="form-control" value="{{ old('expense_date', optional($expense)->expense_date) }}" required>
</div>

<div class="mb-3">
    <label for="category" class="form-label">Categoria</label>
    <input type="text" name="category" id="category" class="form-control" value="{{ old('category', optional($expense)->category) }}" required>
</div>

<div class="mb-3">
    <label for="notes" class="form-label">Notas</label>
    <textarea name="notes" id="notes" class="form-control">{{ old('notes', optional($expense)->notes) }}</textarea>
</div>
