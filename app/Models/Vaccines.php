<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccines extends Model
{
    use HasFactory;

    protected $fillable = [
    'animal_type',
    'vaccine_name',
    'deleted_at',
    ];
}
