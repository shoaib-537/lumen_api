<?php

namespace App\Models;
use HasFactory;

use Illuminate\Database\Eloquent\Model;

class product extends Model

{

    protected $fillable = [
        'title', 'price', 'photo', 'description'
    ];
}
