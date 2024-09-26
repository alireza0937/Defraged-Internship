<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteOtpJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $userdata)
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        UserOtp::query()->where("user_id", $this->userdata->id)->delete();
    }
}
