<?php

namespace App\Service;

class ActorConverter
{
    public function getFullName(string $fName, string $lName): string
    {
        return sprintf('%s %s', $fName, $lName);
    }
}