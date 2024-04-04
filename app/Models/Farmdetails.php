<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmdetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'email',
       'website',
        'farm_farmid',
    ];
}
