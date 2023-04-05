<?php

namespace App\Policies\Item;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Tagd\Core\Models\Actor\Retailer as RetailerModel;
use Tagd\Core\Models\Item\Tagd as TagdModel;

class Tagd
{
    use HandlesAuthorization; // HandlesGenericUsers;

    /**
     * Determine whether the user can list.
     *
     * @param  RetailerModel  $retailer
     * @return mixed
     */
    public function index(User $user, RetailerModel $actor)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can show details.
     *
     * @return mixed
     */
    public function show(User $user, TagdModel $tagd, RetailerModel $retailer)
    {
        return $tagd->item->retailer_id == $retailer->id
            ? Response::allow()
            : Response::deny();
    }
}
