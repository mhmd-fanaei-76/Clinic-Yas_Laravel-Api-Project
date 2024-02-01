<?php

namespace App\Jobs;

use App\Models\Turn;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RemoveOldTurns implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected static $day =30;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        Turn::query()->where('turns_date','<=',now()->subDays(self::$day))->delete();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
