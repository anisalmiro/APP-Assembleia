<?php

namespace App\Exports;

use App\Models\FinancialTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        return FinancialTransaction::with('member')->get()->map(function ($t) {
            return [
                'ID' => $t->id,
                'Membro' => optional($t->member)->first_name . ' ' . optional($t->member)->last_name,
                'Tipo' => $t->type,
                'Valor' => $t->amount,
                'Data' => $t->transaction_date,
                'Notas' => $t->notes,
            ];
        });
    }

    public function headings(): array
    {
        return ['ID', 'Membro', 'Tipo', 'Valor', 'Data', 'Notas'];
    }
}
