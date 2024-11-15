<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsBill extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
}
