<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\SecurityPrice;

class SecurityPriceJob implements ShouldQueue
{
    use Queueable;

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
        // Securities/Stock prices in database
        $securityPrices = SecurityPrice::with('security')->get();

        // API Pricing data from an external provider according to single security type.
        $responseAPI = '
        {
            "results": [
                {
                    "symbol": "APPL",
                    "price": 188.97,
                    "last_price_datetime": "2023-10-30T17:31:18-04:00"
                },
                {
                    "symbol": "TSLA",
                    "price": 244.42,
                    "last_price_datetime": "2023-10-30T17:32:11-04:00"
                }
            ]
        }';
        $data = json_decode($responseAPI, true);

        foreach ($securityPrices as $value) {

            foreach ($data['results'] as $item) {

                // You can only access prices that exist
                // Check the symbol, to only update the corresponding prices.
                if ($value->security->symbol == $item['symbol']) {
                    $value->last_price = $item['price'];
                    $value->save();
                }

            }
        }
    }
}
