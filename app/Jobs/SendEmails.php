<?php

namespace App\Jobs;

use App\Mail\SendCarMail;
use App\Mail\SendCodeMail;
use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::where('role_id',1)
            ->where('statusCode',1)
            ->get();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new SendCarMail('message'));
        }
    }

    public function failed(Exception $exception)
    {

        Log::channel('job_failures')->error('Job failed', [
            'job' => static::class,
            'exception' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);
    }

    public function tries()
    {
        return 2;
    }

    public function retryAfter()
    {
        return 3;
    }
}
