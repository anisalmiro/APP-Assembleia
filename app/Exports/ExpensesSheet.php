<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpensesSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Expense::all()->map(function ($e) {
            return [
                'ID' => $e->id,
                'Descrição' => $e->description,
                'Categoria' => $e->category,
                'Valor' => $e->amount,
                'Data' => $e->expense_date,
                'Notas' => $e->notes,
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Descrição', 'Categoria', 'Valor', 'Data', 'Notas'];
    }
}
