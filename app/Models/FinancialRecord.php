<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialRecord extends Model
{
    use HasFactory;

    protected $fillable = [
      'recordid',
       'farm_farmid',
        'type_of_finance',
        'amount',
      'date_of_finance',
        'details'
    ];
}
