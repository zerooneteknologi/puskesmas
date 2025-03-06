<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emergency extends Model
{
    /** @use HasFactory<\Database\Factories\EmergencyFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [''];
}
