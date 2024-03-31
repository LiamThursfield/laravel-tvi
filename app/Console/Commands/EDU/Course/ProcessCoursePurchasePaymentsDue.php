<?php

namespace App\Console\Commands\EDU\Course;

use Illuminate\Console\Command;
use Stancl\Tenancy\Concerns\HasATenantArgument;
use Stancl\Tenancy\Concerns\TenantAwareCommand;

class ProcessCoursePurchasePaymentsDue extends Command
{
    use TenantAwareCommand, HasATenantArgument;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:process-purchase-payments-due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fires a job to process purchase payments due today.';


    public function handle() : void
    {
        dispatch(new \App\Jobs\EDU\Course\ProcessCoursePurchasePaymentsDue());
    }
}
