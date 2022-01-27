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

        return $this->prettyTimeAction->handle($this->hours, $this->minutes, $this->seconds);
    }
}