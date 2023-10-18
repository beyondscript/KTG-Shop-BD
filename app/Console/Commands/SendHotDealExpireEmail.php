<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hotdeal;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendHotDealExpireEmails;

class SendHotDealExpireEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendhotdealexpireemail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send a email to the admin when a hot deal is expired.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hotdeal=Hotdeal::where('expired', '1')->first();
        if ($hotdeal) {
            $admin = User::where('type', 'admin')->first();
            Mail::to($admin->email)->send(new SendHotDealExpireEmails($admin, $hotdeal));
        }
    }
}
