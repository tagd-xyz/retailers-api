<?php

namespace App\Policies\Item;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Tagd\Core\Models\Actor\Retailer as RetailerModel;
use Tagd\Core\Models\Item\Item as ItemModel;

class Item
{
    use HandlesAuthorization; // HandlesGenericUsers;

    /**
     * Determine whether the user can list.
     *
     * @param  User  $user
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
     * @param  User  $user
     * @param  ItemModel  $item
     * @param  RetailerModel  $retailer
     * @return mixed
     */
    public function show(User $user, ItemModel $item, RetailerModel $retailer)
    {
        return $item->retailer_id == $retailer->id
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can store.
     *
     * @param  User  $user
     * @param  RetailerModel  $retailer
     * @return mixed
     */
    public function store(User $user, RetailerModel $retailer)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can delete details.
     *
     * @param  User  $user
     * @param  ItemModel  $item
     * @param  RetailerModel  $retailer
     * @return mixed
     */
    public function destroy(User $user, ItemModel $item, RetailerModel $retailer)
    {
        //TODO: check status
        return $item->retailer_id == $retailer->id
            ? Response::allow()
            : Response::deny();
    }
}
