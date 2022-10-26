<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Livewire\Campaign\Create as CampaignCreate;
use App\Http\Livewire\Campaign\Index as CampaignIndex;
use App\Http\Livewire\Campaign\Show as CampaignShow;
use App\Http\Livewire\OrganizationSetup;
use App\Http\Livewire\Organization\Show as OrganizationShow;
use App\Http\Livewire\Recipient\Import as RecipientImport;
use Lorisleiva\Actions\Facades\Actions;
use App\Actions\PrintLabels;

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
    Route::get('/campaign', CampaignIndex::class)->name('campaign.index');
    Route::get('/campaign/create', CampaignCreate::class)->name('campaign.create');
    Route::get('/campaign/{campaign}', CampaignShow::class)->name('campaign.show');
    Route::get('/campaign/{slug}/labels', PrintLabels::class)->name('campaign.label');

    Route::post('/recipient/import', [ImportController::class, 'setupImport'])->name('recipient.import');
    Route::post('/recipient/setup', [ImportController::class, 'setupColumn'])->name('recipient.column');
});
