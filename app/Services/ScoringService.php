<?php

namespace App\Services;

use App\Models\Option;

class ScoringService
{
    /**
     * Calculate total score from an array of option IDs.
     */
    public function calculateScore(array $optionIds): int
    {
        return Option::whereIn('id', $optionIds)->sum('points');
    }

    /**
     * Get points for a specific option (for snapshot).
     */
    public function getOptionPoints(int $optionId): int
    {
        return Option::findOrFail($optionId)->points;
    }
}
