<?php

namespace App\Jobs;

use App\Helpers\LogHelper;
use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteOldEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->delete();
        LogHelper::logInfo('deleteOldEmails', 'Job DeleteEmails success', ['data' => $this->user]);
    }


    public function failed(Exception $exception)
    {
        LogHelper::logError('deleteOldEmails', 'Job DeleteEmails failed', [
            'job' => static::class,
            'exception' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);
    }

    public function tries()
    {
        return 5;
    }

    public function retryAfter()
    {
        return 3;
    }
}
