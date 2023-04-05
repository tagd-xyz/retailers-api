<?php

namespace App\Policies\Item;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Tagd\Core\Models\Actor\Retailer as RetailerModel;
use Tagd\Core\Models\Item\Stock as StockModel;

class Stock
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
     * Determine whether the user can store.
     *
     * @return mixed
     */
    public function store(User $user, RetailerModel $retailer)
    {
        return Response::allow();
    }

    /**
     * Determine whether the user can show details.
     *
     * @return mixed
     */
    public function show(User $user, StockModel $stock, RetailerModel $retailer)
    {
        return $stock->retailer_id == $retailer->id
            ? Response::allow()
            : Response::deny();
    }

    /**
     * Determine whether the user can destroy.
     *
     * @return mixed
     */
    public function destroy(User $user, StockModel $stock, RetailerModel $retailer)
    {
        // TODO: add tagd status check
        return $stock->retailer_id == $retailer->id
            ? Response::allow()
            : Response::deny();
    }
}
