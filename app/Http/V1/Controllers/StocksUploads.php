<?php

namespace App\Http\V1\Controllers;

use App\Http\V1\Requests\ImageRequest\Store as StoreRequest;
use App\Http\V1\Resources\Upload\Single as UploadSingle;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Tagd\Core\Repositories\Interfaces\Items\Stock as StocksRepo;
use Tagd\Core\Repositories\Interfaces\Uploads\Stocks as StocksUploadsRepo;

class StocksUploads extends BaseController
{
    /**
     * Get basic status info
     *
     * @return Illuminate\Http\JsonResponse
     */
    public function store(
        StocksRepo $stocksRepo,
        StocksUploadsRepo $uploadsRepo,
        string $stockId,
        StoreRequest $request
    ) {
        $user = Auth::user();

        //auth

        $stock = $stocksRepo->findById($stockId);

        $upload = $uploadsRepo->image(
            $stock->id,
            $request->get(StoreRequest::FILE_NAME)
        );

        return response()->withData(
            new UploadSingle($upload),
            201
        );
    }
}
