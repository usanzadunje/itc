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

    public function times(): HasMany {
        return $this->hasMany(Time::class)
            ->latest();
    }
}
