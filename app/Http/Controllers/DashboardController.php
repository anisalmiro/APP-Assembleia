<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Asset;
use App\Models\FinancialTransaction;
use App\Models\Expense;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MembersExport;
use Barryvdh\DomPDF\Facade\Pdf;


class DashboardController extends Controller
{
    public function index()
    {
        // Estatísticas gerais para o dashboard
        $totalMembers = Member::count();
        $totalAssets = Asset::count();
        $totalAssetsValue = Asset::sum('value');

        // Transações financeiras do mês atual
        $currentMonth = now()->format('Y-m');
        $monthlyTithes = FinancialTransaction::where('type', 'tithe')
            ->whereRaw("DATE_FORMAT(transaction_date, '%Y-%m') = ?", [$currentMonth])
            ->sum('amount');

        $monthlyDonations = FinancialTransaction::where('type', 'donation')
            ->whereRaw("DATE_FORMAT(transaction_date, '%Y-%m') = ?", [$currentMonth])
            ->sum('amount');

        $monthlyCollections = FinancialTransaction::where('type', 'collection')
            ->whereRaw("DATE_FORMAT(transaction_date, '%Y-%m') = ?", [$currentMonth])
            ->sum('amount');

        $monthlyExpenses = Expense::whereRaw("DATE_FORMAT(expense_date, '%Y-%m') = ?", [$currentMonth])
            ->sum('amount');

        // Últimas transações
        $recentTransactions = FinancialTransaction::with('member')
            ->orderBy('transaction_date', 'desc')
            ->limit(5)
            ->get();

        // Últimas despesas
        $recentExpenses = Expense::orderBy('expense_date', 'desc')
            ->limit(5)
            ->get();


        return view('dashboard', compact(
            'totalMembers',
            'totalAssets',
            'totalAssetsValue',
            'monthlyTithes',
            'monthlyDonations',
            'monthlyCollections',
            'monthlyExpenses',
            'recentTransactions',
            'recentExpenses'
        ));
    }

    public function financialReport(Request $request)
    {
        $transactionsQuery = FinancialTransaction::with('member');
        $expensesQuery = Expense::query();

        // Filtros para transações financeiras
        if ($request->filled('transaction_date_from')) {
            $transactionsQuery->whereDate('transaction_date', '>=', $request->transaction_date_from);
        }
        if ($request->filled('transaction_date_to')) {
            $transactionsQuery->whereDate('transaction_date', '<=', $request->transaction_date_to);
        }
        if ($request->filled('type')) {
            $transactionsQuery->where('type', $request->type);
        }

        // Filtros para despesas
        if ($request->filled('expense_date_from')) {
            $expensesQuery->whereDate('expense_date', '>=', $request->expense_date_from);
        }
        if ($request->filled('expense_date_to')) {
            $expensesQuery->whereDate('expense_date', '<=', $request->expense_date_to);
        }
        if ($request->filled('category')) {
            $expensesQuery->where('category', 'like', '%' . $request->category . '%');
        }

        $transactions = $transactionsQuery->orderBy('transaction_date', 'desc')->paginate(20);
        $expenses = $expensesQuery->orderBy('expense_date', 'desc')->paginate(20);

        return view('reports.financial', compact('transactions', 'expenses'));
    }


    public function membersReport(Request $request)
    {
        $query = Member::with(['spouse', 'children']);

        if ($request->filled('birth_date')) {
            $query->whereDate('date_of_birth', $request->birth_date);
        }

        if ($request->filled('marital_status')) {
            $query->where('marital_status', $request->marital_status);
        }

        if ($request->filled('donation_type')) {
            // Exemplo: filtrar membros que fizeram doações do tipo selecionado
            $query->whereHas('financialTransactions', function($q) use ($request) {
                $q->where('type', $request->donation_type);
            });
        }

        $members = $query->orderBy('first_name')->paginate(20);

        return view('reports.members', compact('members'));
    }

    public function assetsReport()
    {
        $assets = Asset::orderBy('name')
            ->paginate(20);

        return view('reports.assets', compact('assets'));
    }

    public function exportMembers(Request $request)
    {
        $format = $request->format; // espera 'excel' ou 'pdf'

        // Query base - você pode aplicar filtros conforme necessidade
        $query = Member::with(['spouse', 'children']);

        // Se quiser, aplique filtros do $request aqui
        // Exemplo: filtrar por gênero
        if ($request->has('gender') && in_array($request->gender, ['male', 'female', 'other'])) {
            $query->where('gender', $request->gender);
        }

        $members = $query->orderBy('first_name')->get();

        if ($format === 'excel') {
            // Exportar para Excel usando Laravel Excel
            return Excel::download(new MembersExport($members), 'members.xlsx');
        } elseif ($format === 'pdf') {
            // Exportar para PDF usando dompdf
            $pdf = PDF::loadView('reports.members-pdf', compact('members'));
            return $pdf->download('members.pdf');
        }

        abort(404);
    }

    public function exportAssets(Request $request)
    {
        $format = $request->format; // 'excel' ou 'pdf'

        // Consulta base (aqui pode incluir filtros do $request)
        $query = Asset::query();

        // Exemplo: filtrar por status (se enviado)
        if ($request->has('status') && in_array($request->status, ['new', 'good', 'damaged', 'discarded'])) {
            $query->where('status', $request->status);
        }

        // Outros filtros aqui, se quiser (ex: data, categoria...)

        $assets = $query->orderBy('name')->get();

        if ($format === 'excel') {
            // Usando Laravel Excel - crie um Export que aceita a coleção
            return Excel::download(new AssetsExport($assets), 'assets.xlsx');
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('reports.assets-pdf', compact('assets'));
            return $pdf->download('assets.pdf');
        }

        abort(404);
    }

    public function financialReportExport(Request $request)
    {
        $format = $request->format; // 'excel' ou 'pdf'

        $transactions = FinancialTransaction::with('member')->orderBy('transaction_date', 'desc')->get();
        $expenses = Expense::orderBy('expense_date', 'desc')->get();

        if ($format === 'excel') {
            return Excel::download(new FinancialReportExport($transactions, $expenses), 'relatorio_financeiro.xlsx');
        } elseif ($format === 'pdf') {
            $pdf = PDF::loadView('reports.financial-pdf', compact('transactions', 'expenses'));
            return $pdf->download('relatorio_financeiro.pdf');
        }

        abort(404);
    }

    public function exportFinancialReport(Request $request)
    {
        return Excel::download(new FinancialReportExport(), 'relatorio-financeiro.xlsx');
    }

}
