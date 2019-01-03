<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use App\Jobs\UpdateLossForWeighin;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateLoss extends Action implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $weighins
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $weighins)
    {
        $weighins->each(function ($weighin) {
            /* @var \App\Weighin $weighin */
            dispatch(new UpdateLossForWeighin($weighin));
            $this->markAsFinished($weighin);
        });
    }
}
