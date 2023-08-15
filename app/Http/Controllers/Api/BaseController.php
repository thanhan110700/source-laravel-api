<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * Response structure json success.
     *
     * @param  array  $data       Data return
     * @param  int  $statusCode Status code 2xx : 200, 201
     * @return Illuminate\Http\Response response data json
     */
    public function responseSuccess($data = [], $statusCode = 200)
    {
        return response()->json($data, $statusCode);
    }

    /**
     * Response structure json success.
     *
     * @param  array  $data       Data return
     * @param  int  $statusCode Status code 2xx : 200, 201
     * @return Illuminate\Http\Response response data json
     */
    public function responseNotFound($detail = '', $statusCode = 404)
    {
        return response()->json([
            'message' => 'Resource Not Found',
            'detail' => $detail,
            'code' => $statusCode,
        ], $statusCode);
    }

    /**
     * Collections          $resources  resources
     * LengthAwarePaginator $pagination pagination
     */
    protected function parsePagination(LengthAwarePaginator $dataPagination)
    {
        return [
            'current_page' => $dataPagination->currentPage(),
            'from' => $dataPagination->firstItem(),
            'to' => $dataPagination->lastItem(),
            'last_page' => $dataPagination->lastPage(),
            'last_page_url' => $dataPagination->url($dataPagination->lastPage()),
            'next_page_url' => $dataPagination->nextPageUrl(),
            'path' => $dataPagination->path(),
            'per_page' => $dataPagination->perPage(),
            'prev_page_url' => $dataPagination->previousPageUrl(),
            'total' => $dataPagination->total(),
        ];
    }
}
