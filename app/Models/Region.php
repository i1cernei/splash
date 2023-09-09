<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use App\Models\Company;
use App\Models\Locality;


class Region extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function localities(): HasMany {
        return $this->hasMany(Locality::class);
    }

    public function companies(): HasManyThrough {
        return $this->hasManyThrough(Company::class, Locality::class);
    }
}
