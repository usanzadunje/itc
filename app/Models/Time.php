<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Time extends Model
{
    use HasFactory;

    protected $fillable = [
        'time_spent',
    ];

    public function project(): BelongsTo {
        return $this->belongsTo(Project::class);
    }
}
