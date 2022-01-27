<?php

namespace App\Actions;

class GetIntTimePartsAction
{
    /**
     * Returns array of integer values where each one represents time interval
     *
     * [ hours, minutes, seconds ]
     *
     * @param string $time
     * @return int[]
     */
    public function handle(string $time): array {
        // Stripping white spaces from left and right side
        $time = trim($time);

        $timeParts = explode(':', $time);

        if(count($timeParts) < 3) {
            $timeParts = [0, 0, 0];
        }else {
            $timeParts = array_map(fn($el) => (int)$el, $timeParts);
        }

        return $timeParts;
    }
}