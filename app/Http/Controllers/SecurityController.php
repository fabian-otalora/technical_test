<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SecurityRequest;
use App\Models\SecurityPrice;
use App\Services\SecurityPriceService;

class SecurityController extends Controller
{
    protected $securityPriceService;

    public function __construct(SecurityPriceService $securityPriceService)
    {
        $this->securityPriceService = $securityPriceService;
    }

    /**
     * Syncing our security prices for a single security type.
     */
    public function syncSecurityPrices(SecurityRequest $request){
        try {
            $syncPrice = $this->securityPriceService->updatePrice($request);
            $response = [
                "status" => 201,
                "sync" => $syncPrice,
            ];
            return response()->json($response, 201);

        } catch (\Throwable $e) {
            $response = [
                "status" => 500,
                "message" => "Error syncing security prices",
                "error" => $e->getMessage()
            ];
            return response()->json($response, 500);
        }
    }

}
