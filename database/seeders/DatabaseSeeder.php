<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use App\Models\Spouse;
use App\Models\Child;
use App\Models\Asset;
use App\Models\FinancialTransaction;
use App\Models\Expense;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar membros de exemplo
        $member1 = Member::create([
            'first_name' => 'Anisio',
            'last_name' => 'Bule',
            'date_of_birth' => '1980-05-15',
            'gender' => 'male',
            'address' => 'Rua das Flores, 123, Centro',
            'phone_number' => '(+258) 99999-1234',
            'email' => 'anisio.teste@email.com',
            'marital_status' => 'solteiro',
            'date_joined' => '2020-01-15',
            'notes' => 'Líder do grupo de jovens'
        ]);

        // Criar esposa
        Spouse::create([
            'member_id' => $member1->id,
            'first_name' => 'Amelia',
            'last_name' => 'Munguambe',
            'date_of_birth' => '1990-08-20',
            'phone_number' => '(11) 99999-5678',
            'email' => 'maria.silva@email.com'
        ]);

        // Criar filhos
        Child::create([
            'member_id' => $member1->id,
            'first_name' => 'Pedro',
            'last_name' => 'Silva',
            'date_of_birth' => '2010-03-10',
            'gender' => 'male'
        ]);

        Child::create([
            'member_id' => $member1->id,
            'first_name' => 'Ana',
            'last_name' => 'Silva',
            'date_of_birth' => '2012-07-25',
            'gender' => 'female'
        ]);

        $member2 = Member::create([
            'first_name' => 'Carlos',
            'last_name' => 'Santos',
            'date_of_birth' => '1975-12-03',
            'gender' => 'male',
            'address' => 'Av. Principal, 456, Jardim',
            'phone_number' => '(+258) 98888-9999',
            'email' => 'carlos.santos@email.com',
            'marital_status' => 'Casado',
            'date_joined' => '2019-06-20',
            'notes' => 'Responsável pela música'
        ]);

        $member3 = Member::create([
            'first_name' => 'Ana',
            'last_name' => 'Costa',
            'date_of_birth' => '1990-09-12',
            'gender' => 'female',
            'address' => 'Rua da Paz, 789, Vila Nova',
            'phone_number' => '(+258) 97777-8888',
            'email' => 'ana.costa@email.com',
            'marital_status' => 'casado',
            'date_joined' => '2021-03-10',
            'notes' => 'Professora da escola dominical'
        ]);

        // Criar itens do patrimônio
        Asset::create([
            'name' => 'Cadeiras de Plástico',
            'description' => 'Cadeiras brancas para o salão principal',
            'quantity' => 50,
            'acquisition_date' => '2020-01-15',
            'value' => 1500.00,
            'status' => 'good'
        ]);

        Asset::create([
            'name' => 'Mesa de Som',
            'description' => 'Mesa de som digital 16 canais',
            'quantity' => 1,
            'acquisition_date' => '2021-05-20',
            'value' => 3500.00,
            'status' => 'good'
        ]);

        Asset::create([
            'name' => 'Microfones',
            'description' => 'Microfones sem fio para cultos',
            'quantity' => 4,
            'acquisition_date' => '2021-05-20',
            'value' => 2000.00,
            'status' => 'good'
        ]);

        Asset::create([
            'name' => 'Projetor',
            'description' => 'Projetor para apresentações',
            'quantity' => 1,
            'acquisition_date' => '2022-02-10',
            'value' => 2500.00,
            'status' => 'good'
        ]);

        // Criar transações financeiras
        FinancialTransaction::create([
            'member_id' => $member1->id,
            'type' => 'tithe',
            'amount' => 500.00,
            'transaction_date' => now()->subDays(5),
            'notes' => 'Dízimo mensal'
        ]);

        FinancialTransaction::create([
            'member_id' => $member2->id,
            'type' => 'tithe',
            'amount' => 300.00,
            'transaction_date' => now()->subDays(3),
            'notes' => 'Dízimo mensal'
        ]);

        FinancialTransaction::create([
            'member_id' => $member3->id,
            'type' => 'donation',
            'amount' => 200.00,
            'transaction_date' => now()->subDays(2),
            'notes' => 'Doação para reforma'
        ]);

        FinancialTransaction::create([
            'member_id' => null,
            'type' => 'collection',
            'amount' => 150.00,
            'transaction_date' => now()->subDays(1),
            'notes' => 'Coleta especial para missões'
        ]);

        // Criar despesas
        Expense::create([
            'description' => 'Conta de energia elétrica',
            'amount' => 250.00,
            'expense_date' => now()->subDays(10),
            'category' => 'utilities',
            'notes' => 'Conta mensal de energia'
        ]);

        Expense::create([
            'description' => 'Material de limpeza',
            'amount' => 80.00,
            'expense_date' => now()->subDays(8),
            'category' => 'maintenance',
            'notes' => 'Produtos para limpeza do templo'
        ]);

        Expense::create([
            'description' => 'Reparo no telhado',
            'amount' => 800.00,
            'expense_date' => now()->subDays(15),
            'category' => 'construction',
            'notes' => 'Conserto de goteiras no telhado'
        ]);
    }
}
