<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper function so we can eager load only single record from relationship
     * @return HasOne
     */
    public function latestTime(): HasOne {
        return $this->hasOne(Time::class)
            ->latest();
    }

    public function times(): HasMany {
        return $this->hasMany(Time::class)
            ->latest();
    }
}
