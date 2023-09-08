<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helper\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Role management
 */
class RoleController extends Controller
{
    /**
     * Display a listing of all roles.
     *
     * Retrieve a list of all available roles.
     *
     * @response 200 {
     *     "data": [
     *         {
     *             "name": "RoleName1"
     *         },
     *         {
     *             "name": "RoleName2"
     *         },
     *         ...
     *     ]
     * }
     *
     * @return JsonResponse
     */
    public function index()
    {
        // return all roles
        return response()->json(['data' => Role::all()], 200);
    }

    /**
     * Store a newly created role.
     *
     * Create a new role with the specified name.
     * @authenticated Admin authentication needed
     * @bodyParam name string required The name of the role (max: 50 characters).
     *
     * @response 201 {
     *     "data": {
     *         "name": "NewRoleName"
     *     },
     *     "message": "Role created successfully"
     * }
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // validate role
        $validated = $request->validate([
            'name' => ['required', 'max:50', 'unique:roles']
        ]);

        // initialise role
        $role = new Role();
        $role->name = $validated['name'];

        // save role
        if($role->save()) {
            return GlobalHelper::response(data: $role, message: 'Role created successfully', status: 201);
        }else{
            return GlobalHelper::error();
        }
    }

    /**
     * Update the specified role in storage.
     *
     * Update the name of the specified role.
     * @authenticated Admin authentication needed
     * @bodyParam name string required The updated name of the role (max: 50 characters).
     *
     * @response 200 {
     *     "data": {
     *         "name": "UpdatedRoleName"
     *     },
     *     "message": "Role updated successfully"
     * }
     *
     * @param Request $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(Request $request, Role $role): JsonResponse
    {
        // validate role
        $validated = $request->validate([
            'name' => ['required', 'max:50', 'unique:roles']
        ]);

        $role->name = $validated['name'];

        // save role
        if($role->save()) {
            return GlobalHelper::response($role, 'Role updated successfully');
        }else{
            return GlobalHelper::error();
        }
    }

}
