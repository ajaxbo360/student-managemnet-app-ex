<?php

namespace App\Models;

use App\Enums\SchoolEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class StudentCard extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'is_internal',
        'description',
        'school',
    ];

    protected $casts = [

        'date_of_birth' => 'date',
        'is_internal' => 'boolean',
        'school' => SchoolEnum::class,
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('pdf')->singleFile();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, StudentCard>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pdfMedia(): MorphOne
    {
        return $this->morphOne(
            Media::class,
            'model',
        );
    }
}
