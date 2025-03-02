<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\FirstPostNotification;
use App\Models\MrgeJob;
use Illuminate\Notifications\Notifiable;

class FirstPostNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Notifiable;

    public $mrgeJob;
    
    public $to;

    /**
     * Create a new job instance.
     */
    public function __construct(MrgeJob $mrgeJob)
    {
        $this->mrgeJob = $mrgeJob;
        $this->to = config('mail.from.address');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Mail::to($this->to)->send(new FirstPostNotification($this->mrgeJob));
    }
}
