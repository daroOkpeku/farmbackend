<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialRecord extends Model
{
    use HasFactory;

    protected $fillable = [
      'tagnumber',
      'production_type',
      'date_fin',
      'items',
      'input_cost',
       'yield',
       'current_value',
       'revenue',
       'profit'
    ];
}
