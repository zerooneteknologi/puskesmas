<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suport extends Model
{
    /** @use HasFactory<\Database\Factories\SuportFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [''];
}
