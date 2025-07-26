<?php

namespace App\Exports;

use App\Models\FinancialTransaction;
use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FinancialReportExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new TransactionsSheet(),
            new ExpensesSheet(),
        ];
    }
}
