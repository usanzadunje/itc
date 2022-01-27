<?php

namespace App\Actions;

class PrettyTimeAction
{
    /**
     * Changes time intervals to their real value, not letting them pass their limit. For minutes/seconds -> number 60
     * also adds leading 0 to time intervals that are less than 10 in value.
     *
     * @param int $hours
     * @param int $minutes
     * @param int $seconds
     * @return string
     */
    public function handle(int $hours, int $minutes, int $seconds): string {
        // Getting only seconds that are left when all minutes(when seconds exceed 60) are transferred to $minutes variable
        $secondsFinal = $seconds % 60;
        // Adding all minutes plus the ones left from when seconds exceed 60
        $minutesFinal = $minutes + (int)($seconds / 60);
        // Adding all hours plus the ones left from when minutes exceed 60
        $hoursFinal = $hours + (int)($minutesFinal / 60);
        // Getting only minutes left after all hours from minutes(when minutes exceed 60) are transferred to $hours variable
        $minutesFinal = $minutesFinal % 60;

        if($secondsFinal < 10) {
            $secondsFinal = "0$secondsFinal";
        }
        if($minutesFinal < 10) {
            $minutesFinal = "0$minutesFinal";
        }
        if($hoursFinal < 10) {
            $hoursFinal = "0$hoursFinal";
        }

        return "$hoursFinal:$minutesFinal:$secondsFinal";
    }
}