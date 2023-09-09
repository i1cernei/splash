<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Company;


class Locality extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region_id'
    ];

    public function companies(): HasMany {
        return $this->hasMany(Company::class);
    }

    public function region(): BelongsTo {
        return $this->belongsTo(Region::class);
    }
}
