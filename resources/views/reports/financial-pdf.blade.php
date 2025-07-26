<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Relatório Financeiro</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { margin-top: 30px; }
    </style>
</head>
<body>
<h1>Relatório Financeiro</h1>

<h2>Transações</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Membro</th>
        <th>Tipo</th>
        <th>Valor (MZN)</th>
        <th>Data</th>
        <th>Observações</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($transactions as $transaction)
    <tr>
        <td>{{ $transaction->id }}</td>
        <td>{{ optional($transaction->member)->first_name }} {{ optional($transaction->member)->last_name }}</td>
        <td>{{ ucfirst($transaction->type) }}</td>
        <td>{{ number_format($transaction->amount, 2, ',', '.') }}</td>
        <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') }}</td>
        <td>{{ $transaction->notes ?? '-' }}</td>
    </tr>
    @endforeach
    </tbody>
</table>

<h2>Despesas</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Descrição</th>
        <th>Categoria</th>
        <th>Valor (MZN)</th>
        <th>Data</th>
        <th>Observações</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($expenses as $expense)
    <tr>
        <td>{{ $expense->id }}</td>
        <td>{{ $expense->description }}</td>
        <td>{{ $expense->category }}</td>
        <td>{{ number_format($expense->amount, 2, ',', '.') }}</td>
        <td>{{ \Carbon\Carbon::parse($expense->expense_date)->format('d/m/Y') }}</td>
        <td>{{ $expense->notes ?? '-' }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
