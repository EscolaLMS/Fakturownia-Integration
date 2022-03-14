<?php

use EscolaLms\FakturowniaIntegration\Http\Controllers\InvoicesApiController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/invoices'], function () {
    Route::get('/{id}', [InvoicesApiController::class, 'read']);
});
