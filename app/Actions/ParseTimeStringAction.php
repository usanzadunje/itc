<?php

namespace App\Actions;

class ParseTimeStringAction
{
    public function __construct(public PrettyTimeAction $prettyTimeAction) {
    }

    /**
     * Extracts number values from given string (e.g. hours, minutes, seconds)
     * and returns pretty version of it in time colon(':') separated format.
     * Format: 22:22:22
     *
     * @param string $timeInput
     * @return string
     */
    public function handle(string $timeInput): string {
        // Extracting all the numbers from given string
        preg_match_all('!\d+!', $timeInput, $regexResult);

        $matches = array_map(fn($el) => (int)$el, $regexResult[0]);

        // Making sure to take only 3 values(hours, minutes, seconds)
        array_splice($matches, 3);

        return $this->prettyTimeAction->handle(...$matches);
    }
}