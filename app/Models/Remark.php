<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Remark extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function reviews(): BelongsToMany{
        return $this->belongsToMany(ResumeReview::class)->withPivot(['description', 'score']);
    }
}
