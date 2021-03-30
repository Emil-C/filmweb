<?php

declare(strict_types=1);

namespace App\Service;

class DurationConverter
{
    public function convertToHours(int $durationInMinutes): string
    {
        $hours = floor($durationInMinutes / 60);
        $minutes = $durationInMinutes % 60;

        if ($hours == 0) {
            return sprintf('%d min.', $minutes);
        } else {
            return sprintf('%d h %d min.', $hours, $minutes);
        }
        
    }
}