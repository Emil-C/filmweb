<?php

declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('duration', [$this, 'convertToHours']),
            new TwigFunction('fullName', [$this, 'getFullName']),
        ];
    }

    public function convertToHours(int $durationInMinutes): string
    {
        $hours = floor($durationInMinutes / 60);
        $minutes = $durationInMinutes % 60;

        if ($hours == 0) {
            return sprintf('%d min.', $minutes);
        } elseif ($minutes === 0) {
            return sprintf('%d h', $hours);
        } else {
            return sprintf('%d h %d min.', $hours, $minutes);            
        }
    }

    public function getFullName(string $fName, string $lName): string
    {
        return sprintf('%s %s', $fName, $lName);
    }

}
