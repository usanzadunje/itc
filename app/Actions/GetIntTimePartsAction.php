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

        try{
            $timeParts = array_map(fn($el) => (int)$el, $timeParts);
        }catch(\Exception $ex){
            $timeParts = [0, 0, 0];
        }

        return $timeParts;
    }
}