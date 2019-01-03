<?php

namespace App\Observers;

use App\Weighin;
use App\Jobs\UpdateLossForWeighin;

class WeighinObserver
{
    /**
     * Handle the weighin "created" event.
     *
     * @param  \App\Weighin  $weighin
     * @return void
     */
    public function created(Weighin $weighin)
    {
        // Handle the created weighin
        dispatch(new UpdateLossForWeighin($weighin));
    }

    /**
     * Handle the weighin "deleted" event.
     *
     * @param  \App\Weighin  $weighin
     * @return void
     */
    public function deleted(Weighin $weighin)
    {
        // Update the weighin that occurs after the updated record.
        if ($affectedWeighin = Weighin::where('user_id', $weighin->user_id)->after($weighin->weighed_at)->first()) {
            dispatch(new UpdateLossForWeighin($affectedWeighin));
        }
    }
}
