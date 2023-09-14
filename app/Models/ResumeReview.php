<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ResumeReview extends Model
{
    use HasFactory, HasUuids;

    public function resume(): BelongsTo{
        return $this->belongsTo(Resume::class);
    }

    public function reviewer(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function remarks(): BelongsToMany{
        return $this->belongsToMany(Remark::class)->withPivot(['description', 'score']);
    }

}
