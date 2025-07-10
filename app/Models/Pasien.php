<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Scope;

class Pasien extends Model
{
    /** @use HasFactory<\Database\Factories\PasienFactory> */
    use HasFactory;

    protected $guarded = [''];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    /**
     * Scope a query to only include search results.
     */
    #[Scope]
    protected function search(Builder $query, $search): void
    {
        $query->when(
            $search ?? false,
            fn($query, $search) => $query
                ->where('pasien_nik', 'like', "%{$search}%")
                ->orWhere('pasien_nomor', 'like', "%{$search}%")
                ->orWhere('pasien_name', 'like', "%{$search}%")
        );
    }
    /**
     * Scope a query to only include filter results.
     */
    public function scopeFilter(Builder $query, $filter)
    {
        $query
            ->when(
                $filter['search'] ?? false,
                fn($query, $search) => $query->search($search)
            )
            ->when(
                $filter['date'] ?? false,
                fn($query, $date) => $query->whereDate('pasien_in', $date)
            )
            ->when(
                $filter['month'] ?? false, fn($query, $month) 
                => $query->where('pasien_in', 'like', "%{$month}%")
            )
            ->when(
                $filter['year'] ?? false, fn($query, $year)
                => $query->where('pasien_in', 'like', "%{$year}%")
            );
    }
}
