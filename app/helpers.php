<?php

if (! function_exists('percentChange')) {
    function percentChange($initialValue, $finalValue, $precision = 1)
    {
        if (abs($initialValue) === 0) {
            return;
        }

        $percentChange = ($finalValue - $initialValue) / abs($initialValue) * 100;

        return round($percentChange, $precision);
    }
}

if (! function_exists('roundRobin')) {
    /**
     * Based on https://en.wikipedia.org/wiki/Round-robin_tournament#Scheduling_algorithm.
     *
     * The circle method is the standard algorithm to create a schedule for a round-robin
     * tournament.
     *
     * @param mixed $competitors
     * @param null $dummy
     * @return \Illuminate\Support\Collection
     */
    function roundRobin($competitors, $dummy = null)
    {
        $competitors = collect($competitors);

        // If there are an odd number of competitors, a dummy competitor can be added,
        // whose scheduled opponent in a given round does not play and has a bye.
        if ($competitors->count() % 2 === 1) {
            $competitors->push($dummy);
        }

        // The maximum number of rounds (before match ups are repeated) is equal to the
        // total number of players minus 1
        $maxRounds = $competitors->count() - 1;

        // Competitors are split into two groups
        /** @var \Illuminate\Support\Collection $groupA */
        /** @var \Illuminate\Support\Collection $groupB */
        [$groupA, $groupB] = $competitors->split(2);

        // For the first round, players from each group are matched up
        $rounds = new \Illuminate\Support\Collection;
        $rounds->push($groupA->zip($groupB));

        // For the remaining rounds the first player is fixed, and all other
        // players rotate clockwise before being matched up again.
        foreach (range(2, $maxRounds) as $round) {
            // Shift the first player off the list, they will remain fixed in position 1
            $fixedPlayer = $groupA->shift();

            // Rotate the remaining players clockwise by placing the last item from groupA
            // at the end of groupB
            $groupB->push($groupA->pop());

            // Then placing the first item from groupB to the beginning of groupA
            $groupA->prepend($groupB->shift());

            // Put the fixed player back at the beginning of groupA
            $groupA->prepend($fixedPlayer);

            // And finally, players from each group are matched up
            $rounds->push($groupA->zip($groupB));
        }

        return $rounds;
    }
}
