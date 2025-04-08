<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable =[
        'external_id',
        'name',
        'kpi',
        'description',
        'price',
        'payout_currency',
        'creatives_url',
        'click_url',
        'preview_url', 
    ];
}
