<?php

namespace App\Jobs;

use App\Weighin;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateLossForWeighin
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Weighin
     */
    public $weighin;

    /**
     * Create a new job instance.
     *
     * @param Weighin $weighin
     */
    public function __construct(Weighin $weighin)
    {
        $this->weighin = $weighin;
    }

    /**
     * Execute the job.
     *
     * @throws \Throwable
     */
    public function handle()
    {
        $this->weighin->loss = percentChange($this->getPreviousWeight(), $this->weighin->weight, 2);
        $this->weighin->saveOrFail();
    }

    /**
     * Get the previous weight.
     *
     * @return float|null
     */
    private function getPreviousWeight()
    {
        $weighin = Weighin::priorTo($this->weighin->weighed_at)
            ->where('user_id', $this->weighin->user_id)
            ->first();

        return optional($weighin)->weight;
    }
}
