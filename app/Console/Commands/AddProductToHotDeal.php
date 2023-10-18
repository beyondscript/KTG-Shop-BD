<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Hotdeal;
use App\Models\Product;

class AddProductToHotDeal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:addproducttohotdeal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will add products to the hot deal until it is expired';

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
        $hotdeal=Hotdeal::where('expired', '0')->first();
        $products = Product::where('category_id', $hotdeal->category_id)->get();
        foreach($products as $product){
            $discountprice = ($product->regularprice / 100) * $hotdeal->discount;
            $discountedprice = $product->regularprice - $discountprice;
            $product->discountedprice = $discountedprice;
            $product->save();
        }
    }
}
