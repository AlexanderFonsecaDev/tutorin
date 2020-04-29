<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\Profile as ProfileResource;
use App\Http\Resources\ProfileCollection;

class ProfileController extends Controller
{

    protected $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function index()
    {
        return response()->json(new ProfileCollection(
            $this->profile->orderBy('id','desc')->get()
        ));
    }

    public function store(ProfileStoreRequest $request)
    {

    }

    public function show(Profile $profile)
    {
        return response()->json(new ProfileResource($profile), 200);
    }

    public function update(ProfileUpdateRequest $request, $id)
    {
        $profile = $this->profile->find($id);
    }

    public function destroy(Profile $profile)
    {
        //
    }
}
