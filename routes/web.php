<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\FinancialTransactionController;
use App\Http\Controllers\ExpenseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rota principal - Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Rotas para gerenciamento de membros (crentes)
Route::resource('members', MemberController::class);

// Rotas para gerenciamento de patrimônio (itens da igreja)
Route::resource('assets', AssetController::class);

// Rotas para transações financeiras (dízimos, doações, coletas)
Route::resource('financial-transactions', FinancialTransactionController::class);

// Rotas para despesas (saídas)
Route::resource('expenses', ExpenseController::class);

// Rotas específicas para relatórios
#Route::get('/reports/financial', [DashboardController::class, 'financialReport'])->name('reports.financial');
Route::get('/reports/members', [DashboardController::class, 'membersReport'])->name('reports.members');
Route::get('/reports/assets', [DashboardController::class, 'assetsReport'])->name('reports.assets');
Route::get('reports/members/export', [DashboardController::class, 'exportMembers'])->name('reports.members.export');

Route::prefix('reports')->group(function () {
    Route::get('/financial', [DashboardController::class, 'financialReport'])->name('reports.financial');

    // Rota para exportar relatório financeiro em Excel ou PDF
    Route::get('/financial/export', [DashboardController::class, 'financialReportExport'])->name('reports.financial.export');
});
// Rota para exportar ativos (Excel ou PDF), recebe parâmetro 'format' na query string
Route::get('reports/assets/export', [DashboardController::class, 'exportAssets'])->name('reports.assets.export');
