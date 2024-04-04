<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedingSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
    'scheduleid',
    'animal_animalid',
    'feed_feedid',
     'date_of_feeding',
       'quantity'
    ];
}
