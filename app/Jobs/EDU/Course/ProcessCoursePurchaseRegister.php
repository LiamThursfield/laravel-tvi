<?php

namespace App\Jobs\EDU\Course;

use App\Mail\EDU\Course\CoursePurchaseRegister;
use App\Models\EDU\Course\CoursePurchasePayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessCoursePurchaseRegister implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly CoursePurchasePayment $payment
    ) {
    }

    public function handle(): void
    {
        Mail::to($this->payment->purchase->email_address)->send(new CoursePurchaseRegister($this->payment));
    }
}
