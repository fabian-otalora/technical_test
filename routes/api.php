<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SecurityController;

// Syncing security prices
Route::post('/syncing_security_prices', [SecurityController::class, 'syncSecurityPrices']);
