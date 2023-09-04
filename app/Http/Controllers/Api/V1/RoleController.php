<?php

namespace App\Http\Controllers\Api\V1;

use App\Helper\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return all roles
        return response()->json(['data' => Role::all()], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate role
        $validated = $request->validate([
            'name' => ['required', 'max:50', 'unique:roles']
        ]);

        // initialise role
        $role = new Role();
        $role->name = $validated->name;

        // save role
        if($role->save()) {
            return GlobalHelper::response($role, 'Role created successfully');
        }else{
            return GlobalHelper::error();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // validate role
        $validated = $request->validate([
            'name' => ['required', 'max:50', 'unique:roles']
        ]);

        $role->name = $validated->name;

        // save role
        if($role->save()) {
            return GlobalHelper::response($role, 'Role updated successfully');
        }else{
            return GlobalHelper::error();
        }
    }

}
