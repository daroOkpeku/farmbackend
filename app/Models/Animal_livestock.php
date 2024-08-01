<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal_livestock extends Model
{
    use HasFactory;

    protected $fillable = [
         'name',
          'sex',
          'image',
          'age',
          'breed',
          'weight',
          'tag_id',
          'health_status',
          'farm_farmid'
    ];

    public function FarmConnect(){
        return $this->belongsTo(Farm::class, 'farm_farmid', 'farmid');
    }
}
