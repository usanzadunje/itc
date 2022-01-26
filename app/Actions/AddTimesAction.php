<?php

namespace App\Actions;

class AddTimesAction
{
    private int $hours = 0;
    private int $minutes = 0;
    private int $seconds = 0;

    public function handle(array $times): string {
        foreach($times as $time){
            list($hours, $minutes, $seconds) = $this->getIntTimeParts($time);

            $this->hours += $hours;
            $this->minutes += $minutes;
            $this->seconds += $seconds;
        }

        // Getting only seconds that are left when all minutes(when seconds exceed 60) are transferred to $minutes variable
        $seconds = $this->seconds % 60;
        // Adding all minutes plus the ones left from when seconds exceed 60
        $minutes = $this->minutes + (int)($this->seconds / 60);
        // Adding all hours plus the ones left from when minutes exceed 60
        $hours = $this->hours + (int)($minutes / 60);
        // Getting only minutes left after all hours from minutes(when minutes exceed 60) are transferred to $hours variable
        $minutes = $minutes % 60;

        return $this->prettyTime($hours, $minutes, $seconds);
    }

    /**
     * Returns array of integer values where each one represents time interval
     *
     * [ hours, minutes, seconds ]
     * @param string $time
     * @return int[]
     */
    private function getIntTimeParts(string $time): array {
        // Stripping white spaces from left and right side
        $time = trim($time);

        $timeParts = explode(':', $time);

        return [(int)$timeParts[0], (int)$timeParts[1], (int)$timeParts[2]];
    }

    /**
     * Simple function which adds leading 0's if hours, minutes, seconds are less than 10
     * e.g. 8 -> 08
     *
     * @param int $hours
     * @param int $minutes
     * @param int $seconds
     * @return string
     */
    private function prettyTime(int $hours, int $minutes, int $seconds): string {
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