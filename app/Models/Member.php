<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'address',
        'phone_number',
        'email',
        'marital_status',
        'date_joined',
        'notes'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'date_joined' => 'date',
    ];

    // Relacionamento com esposa (um para um)
    public function spouse()
    {
        return $this->hasOne(Spouse::class);
    }

    // Relacionamento com filhos (um para muitos)
    public function children()
    {
        return $this->hasMany(Child::class);
    }

    // Relacionamento com transações financeiras (um para muitos)
    public function financialTransactions()
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    // Método para obter o nome completo
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
