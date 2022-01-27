<?php

namespace App\Actions;

class PrettyTimeAction
{
    /**
     * Simple function which adds leading 0's if hours, minutes, seconds are less than 10
     * e.g. 8 -> 08
     *
     * @param int $hours
     * @param int $minutes
     * @param int $seconds
     * @return string
     */
    public function handle(int $hours, int $minutes, int $seconds): string {
        if($seconds < 10) {
            $seconds = "0$seconds";
        }
        if($minutes < 10) {
            $minutes = "0$minutes";
        }
        if($hours < 10) {
            $hours = "0$hours";
        }

        return "$hours:$minutes:$seconds";
    }
}