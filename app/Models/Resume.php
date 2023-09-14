<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resume extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function reviews(): HasMany{
        return $this->hasMany(ResumeReview::class);
    }

}
