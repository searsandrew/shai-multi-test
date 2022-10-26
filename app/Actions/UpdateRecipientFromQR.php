<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Routing\Router;

class UpdateRecipientFromQR
{
    use AsAction;

    public function handle()
    {
        // ...
    }

    public static function routes(Router $router)
    {
        $router->get('/recipient/{recipient}/qr', static::class)->name('recipient.qr');
    }
}
