<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RemarkResumeReview extends Model
{
    use HasFactory, HasUuids;

    /**
     * Define the relationship to the Remark model.
     */
    public function remark(): BelongsTo
    {
        return $this->belongsTo(Remark::class);
    }
}
