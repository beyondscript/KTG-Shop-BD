<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hotdeal;
use App\Models\Product;
use Carbon\Carbon;

class ExpireHotDeal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:expirehotdeal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will expire all the hot deals which have passed their expiry date';

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
        $hotdeal=Hotdeal::whereDate('date', '<', Carbon::now()->toDateTimeString())->where('expired', '0')->first();
        $products = Product::where('category_id', $hotdeal->category_id)->get();
        foreach($products as $product){
            $product->discountedprice = $product->regularprice;
            $product->save();
        }

        $hotdeal->expired = true;
        $hotdeal->save();
    }
}
