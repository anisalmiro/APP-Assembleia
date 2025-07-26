<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'type',
        'amount',
        'transaction_date',
        'notes'
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
        'amount' => 'decimal:2',
    ];

    // Relacionamento com membro (pertence a um)
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
