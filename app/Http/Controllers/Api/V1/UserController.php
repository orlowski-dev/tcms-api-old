<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Filters\V1\UserFilter;
use App\Http\Requests\V1\StoreUserRequest;
use App\Http\Requests\V1\UpdateUserRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new UserFilter();
        $filteredQuery = $filter->transform($request);
        $includeRole = $request->get('includeRole');
        $includeProfile = $request->get('includeProfile');


        $users = User::where($filteredQuery);

        if ($includeRole) {
            $users = $users->with('role');
        }

        if ($includeProfile) {
            $users = $users->with('profile');
        }

        return new UserCollection($users->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $newUser = User::create($request->all());
        Profile::create([
            'user_id' => $newUser->id
        ]);
        return new UserResource($newUser);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        $includeRole = $request->get('includeRole');
        $includeProfile = $request->get('includeProfile');

        if ($includeRole) {
            $user = $user->load('role');
        }

        if ($includeProfile) {
            $user = $user->load('profile');
        }

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'User has been deleted.'
        ]);
    }
}
