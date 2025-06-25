<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Testing\Fluent\Concerns\Has;

class Note extends Model
{
    /** @use HasFactory<\Database\Factories\PersonnelFactory> */
    use HasFactory;

    protected $guarded = [''];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    /**
     * Scope a query to filter note by nomor.
     */
    #[Scope]
    protected function nomor(Builder $query, $nomor): void
    {
        $query->when(
            $nomor ?? false,
            fn($query, $nomor) => $query->whereHas('pasien', function (
                $query
            ) use ($nomor) {
                $query->where('pasien_nomor', 'like', '%' . $nomor . '%');
            })
        );
    }

    /**
     * Scope a query to filter note by date.
     */
    #[Scope]
    protected function date(Builder $query, $date): void
    {
        $query->when(
            $date ?? false,
            fn($query, $date) => $query->where(
                'note_date',
                'like',
                '%' . $date . '%'
            )
        );
    }
}
