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
        $user_profile =  User::find($request->user_id);

        if ($request->hasFile('avatar')) {
            $exploded = explode(',', $request->avatar);
            $decoded = base64_decode($exploded[1]);
            if(str_contains($exploded[0],'jpeg'))
                $extension = 'jpg';
            else
                $extension = 'png';

            $filename = str_random() . '.' . $extension;
            $path = public_path().'/avatar/'.$filename;
            file_put_contents($path,$decoded);
            $user_profile->profile()->image()->save(Image::make(['url' => $filename]));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return response()->json(new ProfileResource($profile), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request, $id)
    {
        $profile = $this->profile->find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
