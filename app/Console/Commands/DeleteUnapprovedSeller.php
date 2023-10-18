<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Sellerdetail;
use Carbon\Carbon;

class DeleteUnapprovedSeller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:deleteunapprovedseller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will delete all the sellers who are unapproved for more than 1 month';

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
        $seller=User::whereDate('created_at', '<', Carbon::now()->subMonth(1)->toDateTimeString())->where('approved', '0')->get();
        foreach ($seller as $slr) {
            if ($slr->image == 'public/images/users/images/default.webp') {
                Sellerdetail::where('user_id', $slr->id)->delete();
                $slr->delete();
            }
            else{
                if(file_exists($slr->image)){
                    unlink($slr->image);
                    Sellerdetail::where('user_id', $slr->id)->delete();
                    $slr->delete();
                }
                else{
                    Sellerdetail::where('user_id', $slr->id)->delete();
                    $slr->delete();
                }
            }
        }
    }
}
