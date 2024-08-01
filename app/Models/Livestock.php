<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livestock extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_id',
        'passport_id',
        'keeper_id',
        'owner_id',
        'livestock_type',
        'livestock_breed',
        'gender',
        'health_status',
        'gestation_date',
        'description',
        'verification_photo',
        'muzzle_photo',
        'tagging_loc_id',
        'other_comments',
        'weight',
        'production_type',
        'TIMESTAMP',
        'captured_by',
        'del_flg',
        'death_flg',
        'exit_date',
        'exit_type',
        'assigned_flg',
        'published_flg',
        'sold_flg',
        'missing_flg'
    ];
}
