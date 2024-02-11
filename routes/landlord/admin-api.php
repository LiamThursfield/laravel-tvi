<?php

use App\Http\Controllers\Landlord\AdminApi\TenantDomainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Landlord Admin API Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'as' => 'tenants.',
    'prefix' => 'tenants/{tenant}'
], function() {
    Route::resource('domains', TenantDomainController::class)
        ->only(['destroy', 'store', 'update']);
});
