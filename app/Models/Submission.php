<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Submission extends Model
{
    protected $fillable = [
        'period_id',
        'opd_id',
        'respondent_name',
        'respondent_position',
        'respondent_phone',
        'respondent_email',
        'total_score',
    ];

    public function period(): BelongsTo
    {
        return $this->belongsTo(Period::class);
    }

    public function opd(): BelongsTo
    {
        return $this->belongsTo(Opd::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
