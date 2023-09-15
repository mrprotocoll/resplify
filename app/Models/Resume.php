<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Resume extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'job_titles'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function reviews(): HasMany{
        return $this->hasMany(ResumeReview::class);
    }

    /**
     * uploads and creates a new résumé in DB
     * @param UploadedFile $resume
     * @param string|null $jobTitles
     * @return mixed
     */
    public static function upload(UploadedFile $resume, string $jobTitles = null)
    {
        $user = User::current();
        $resumeName = "resumes/" . FileHelper::formatName($resume->getClientOriginalName());

        // Store the résumé in the 'public' disk (storage/app/public)
        Storage::disk('public')->put($resumeName, file_get_contents($resume));

        // Save the resume file name in the database
        return $user->resumes()->create(['name' => $resumeName, 'job_titles' => $jobTitles]);
    }

}
