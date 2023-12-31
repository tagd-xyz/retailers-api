<?php

namespace App\Policies\Actor;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Tagd\Core\Models\Actor\Actor as ActorModel;
use Tagd\Core\Models\Actor\Retailer as RetailerModel;
use Tagd\Core\Models\User\User;

class Retailer
{
    use HandlesAuthorization; // HandlesGenericUsers;

    /**
     * Determine whether the user can update details.
     *
     * @return mixed
     */
    public function update(User $user, RetailerModel $retailer, ActorModel $actor)
    {
        // TODO: check ownership
        return Response::allow();
    }
}
