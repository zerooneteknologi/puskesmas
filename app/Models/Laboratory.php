<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laboratory extends Model
{
    /** @use HasFactory<\Database\Factories\LaboratoryFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [''];
}
