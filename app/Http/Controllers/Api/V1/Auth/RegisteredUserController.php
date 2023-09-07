<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Role $role): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::In([RoleEnum::USER, RoleEnum::REVIEWER])]
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach($role);

        event(new Registered($user));

        Auth::login($user);

        $device = substr($request->userAgent() ?? '', 0, 255);
        $token = $user->createToken($device)->plainTextToken;

        return response()->json(['token' => $token, 'data' => new UserResource($user)], 201);

    }

    /**
     * @throws ValidationException
     */
    public function user(Request $request): void
    {
        $this->store($request, Role::where('name', RoleEnum::USER)->first());
    }

    /**
     * @throws ValidationException
     */
    public function reviewer(Request $request): void
    {
        $this->store($request, Role::where('name', RoleEnum::REVIEWER)->first());
    }
}
