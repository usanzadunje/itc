<?php

namespace App\Actions;

class AddTimesAction
{
    private int $hours = 0;
    private int $minutes = 0;
    private int $seconds = 0;

    public function __construct(
        public GetIntTimePartsAction $getIntTimePartsAction,
        public PrettyTimeAction      $prettyTimeAction
    ) {
    }

    /**
     * Adds multiple times, that are provided as string array, together and returns
     * pretty version of them all added together in time colon(':') separated format.
     *
     * @param array $times
     * @return string
     */
    public function handle(array $times): string {
        foreach($times as $time){
            list($hours, $minutes, $seconds) = $this->getIntTimePartsAction->handle($time);

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

        return $this->prettyTimeAction->handle($hours, $minutes, $seconds);
    }
}