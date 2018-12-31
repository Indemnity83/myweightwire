<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

class SetMatchups extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $competitions
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $competitions)
    {
        $competitions->each(function ($competition) {
            /* @var \App\Competition $competition */
            $competition->generateRandomMatchups();
            $this->markAsFinished($competition);
        });
    }
}
