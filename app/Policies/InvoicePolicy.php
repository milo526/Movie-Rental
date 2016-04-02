<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;
use App\Invoice;

class InvoicePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given invoice can be loaded by the user.
     *
     * @param  \App\User  $user
     * @param  \App\Invoice  $invoice
     * @return bool
     */
    public function get(User $user, invoice $invoice)
    {
        return $user->id === $invoice->user_id;
    }
}
