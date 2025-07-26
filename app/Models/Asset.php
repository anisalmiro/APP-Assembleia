<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'acquisition_date',
        'value',
        'status'
    ];

    protected $casts = [
        'acquisition_date' => 'date',
        'value' => 'decimal:2',
    ];
}
