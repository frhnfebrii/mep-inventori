<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectricalPart extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'part_number',
        'brand',
        'quantity',
        'unit'
    ];
}
