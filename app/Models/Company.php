<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    public function locality(): BelongsTo {
        return $this->belongsTo(Locality::class);
    }
}
