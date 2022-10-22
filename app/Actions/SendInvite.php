<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Routing\Router;

use App\Mail\InviteMail;
use App\Models\Invite;

class SendInvite
{
    use AsAction;

    public function handle(string $email)
    {
        $organization = Auth::user()->current_organization;
        $organization()->invites->create([
            'email' => $email,
        ]);

        Mail::to($email)->send(new InviteMail($invite));

    }

    public function asController()
    {

    }

    public static function routes(Router $router)
    {
        $router->get('invite/{code}', static::class)->name('invite.send');
    }
}
