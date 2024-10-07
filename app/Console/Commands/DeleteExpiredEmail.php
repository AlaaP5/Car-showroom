<?php

namespace App\Console\Commands;

use App\Jobs\DeleteOldEmailsJob;
use App\Models\User;
use Illuminate\Console\Command;

class DeleteExpiredEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete emails older than 5 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::where('date', '<=', now()->subMinutes(5))
            ->where('statusCode', 0)
            ->chunk(100, function($users){
                foreach ($users as $user){
                    dispatch(new DeleteOldEmailsJob($user));
                }
            });
    }
}
