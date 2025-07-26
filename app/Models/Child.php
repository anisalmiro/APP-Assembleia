<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    // Relacionamento com membro (pertence a um)
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Método para obter o nome completo
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
