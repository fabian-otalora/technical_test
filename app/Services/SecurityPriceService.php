<?php

namespace App\Services;

use App\Http\Requests\SecurityRequest;
use App\Models\SecurityPrice;
use App\Models\SecurityType;

class SecurityPriceService{

    /**
     * Syncing our security prices for a single security type according to API external.
     */
    public function updatePrice(SecurityRequest $request){

        // Verify if the security type exists
        $verifyType = SecurityType::find($request['security_type']);
        if (!$verifyType) {
            return $response = "Security type not found";
        }

        // Securities/Stock prices in database
        $securityPrices = SecurityPrice::with('security')->get();

        foreach ($securityPrices as $value) {

            // You can only access the prices, according to the type sent in the request.
            if ($value->security->security_type_id == $request['security_type']) {

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

                foreach ($data['results'] as $item) {
                    // Check the symbol, to only update the corresponding prices.
                    if ($value->security->symbol == $item['symbol']) {
                        $previousPrice = $value->last_price;
                        $newPrice = $item['price'];

                        $value->last_price = $item['price'];
                        $value->save();

                        $response[] = ["symbol"=>$value->security->symbol, "previous_price"=>$previousPrice ,"new_price"=>$newPrice];
                    }
                }
            }
        }

        return $response;
    }

}