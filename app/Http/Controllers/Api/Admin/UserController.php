<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Resources\UserDetailResource;
use App\Http\Resources\UserListResource;
use App\Services\UserService;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * NDX-Todo: Transforms the data
 */
class UserController extends BaseController
{
    private $userService;

    public function __construct(
        UserService $userService,
    ) {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? 25;
        $data = $this->userService->paginate($perPage);

        return $this->responseSuccess([
            'data' => UserListResource::collection($data->items()),
            'pagination' => $this->parsePagination($data),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->userService->create($request->all());

        return $this->responseSuccess();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->userService->getById($id);

        return $this->responseSuccess(new UserDetailResource($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->userService->updateById($id, $request->all());

        return $this->responseSuccess($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->userService->deleteById($id);

        return $this->responseSuccess($data);
    }
}
