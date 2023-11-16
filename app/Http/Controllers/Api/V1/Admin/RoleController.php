<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @group Role management
 */
class RoleController extends Controller
{
    public function index()
    {
        // return all roles
        try {
            return ResponseHelper::success(Role::all());
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }

    public function store(Request $request)
    {
        try{
            // validate role
            $validated = $request->validate([
                'name' => ['required', 'max:50', 'unique:roles']
            ]);

            // initialise role
            $role = new Role();
            $role->name = $validated['name'];

            // save role
            $role->save();
            return ResponseHelper::success(data: $role, message: 'Role created successfully', status: 201);

        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }

    public function update(Request $request, Role $role): JsonResponse
    {
        try {

            // validate role
            $validated = $request->validate([
                'name' => ['required', 'max:50', 'unique:roles']
            ]);

            $role->name = $validated['name'];

            // save role
            $role->save();
            return ResponseHelper::success($role, 'Role updated successfully');
        }catch (\Exception $e) {
            Log::error($e);
            return ResponseHelper::error();
        }
    }

}
