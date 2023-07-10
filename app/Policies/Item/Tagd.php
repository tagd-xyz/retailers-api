<?php

namespace App\Policies\Item;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Tagd\Core\Models\Actor\Retailer as RetailerModel;
use Tagd\Core\Models\Item\Tagd as TagdModel;
use Tagd\Core\Models\User\User;

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
     * Determine whether the user can destroy.
     *
     * @return mixed
     */
    public function destroy(User $user, TagdModel $tagd, RetailerModel $retailer)
    {
        // TODO: add tagd status check
        return $tagd->item->retailer_id == $retailer->id
            ? Response::allow()
            : Response::deny();
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

    /**
     * Determine whether the user can activate the item
     *
     * @return mixed
     */
    public function activate(User $user, TagdModel $tagd, RetailerModel $retailer)
    {
        return $tagd->item->retailer_id == $retailer->id
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can deactivate the item
     *
     * @return mixed
     */
    public function deactivate(User $user, TagdModel $tagd, RetailerModel $retailer)
    {
        return $tagd->item->retailer_id == $retailer->id
            ? Response::allow()
            : Response::deny();
    }
}
