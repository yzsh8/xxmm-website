<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Feedback extends Model
{
    //
    protected $table = 'feedback';

    protected $fillable = [
        'name','number','contact','desc'
    ];
}
