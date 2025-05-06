<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gedung extends Model
{
    public function guest(): HasMany
    {
        return $this->hasMany(Guest::class, 'gedung_id');
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_gedungs', 'gedung_id', 'user_id');
    }
}
