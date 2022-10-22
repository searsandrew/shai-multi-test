<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\OrganizationSetup;
use App\Http\Livewire\Organization\Show as OrganizationShow;
use Lorisleiva\Actions\Facades\Actions;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/organization', OrganizationSetup::class)->middleware('auth')->name('organization.setup');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'organization',
    'organization.toggle',
])->group(function () {
    Actions::registerRoutes();

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view('/organization/{organization}', 'livewire.organization.show')->name('organization.show');
});
