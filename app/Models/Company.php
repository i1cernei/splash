<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;
use App\Models\Locality;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cif',
        'locality_id'
    ];

    public function scopeFilter($query , array $filters) {
        if ($filters['search'] ?? false) {
            $query
                ->where('name', 'like', '%' . $filters['search'] .'%')
                ->orWhere('description', 'like', '%' . $filters['search'] .'%')
                ->orWhere('cif', 'like', '%' . $filters['search'] .'%')
                ;

        }
    }

    public function locality(): BelongsTo {
        return $this->belongsTo(Locality::class);
    }


}
