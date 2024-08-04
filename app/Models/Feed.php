<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;
    protected $fillable = [
       'feedid',
       'feedtype',
        'feeddetails',
        'cost',
        'producationtype',
        'ration',
        'ration_composition',
        'disorders',
        'tagnumber'
    ];


    public function feedConnection(){
        return $this->hasOne(FeedingSchedule::class, 'feed_feedid', 'feedid', );
    }
}
