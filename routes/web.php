<?php

use App\Jobs\JobDemo;
use App\Jobs\SendEmails;
use App\Mail\SendCodeMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin/jobs',function(){
//     $user = User::find(1);
//     // queue with cron job and mail

//             //queue with cron job
//     //dispatch(new JobDemo($user));

//     //JobDemo::dispatch($user);


//             //queue with mail
//     Mail::to('php@gmail.com')
//     ->cc('python@gmail.com')
//     ->bcc('java@gmail.com')
//     ->later(now()->addMinutes(1),new SendCodeMail($user));

// });


Route::get('admin/jobs',function() {
    dispatch(new SendEmails);
});
