<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use App\Models\Profile;
use App\Models\Group;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return response()->json(new UserCollection(
            $this->user->where('admin','=',1)
                       ->orderByDesc('id')->get()
        ));
    }

    public function store(UserStoreRequest $request)
    {
        $group = Group::where('name', 'Estudiantes')->get();
        $data_birthday = $request->input('birthday');
        $birthday = Carbon::parse($data_birthday);
        $user = $this->user->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'birthday' => $birthday,
            'gender' => $request->input('gender'),
            'phonenumber' => $request->input('phonenumber'),
            'mobile' => $request->input('mobile'),
            'active' => $request->input('active'),
            'admin' => $request->input('admin'),
        ]);

        $user->profile()->create();
        $user->groups()->attach($group);
        if ($request->input('avatar') != '') {
            $exploded = explode(',', $request->avatar);
            $decoded = base64_decode($exploded[1]);

            if (Str::contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }

            $fileName = Str::random() . '.' . $extension;
            $path = public_path() . '/avatar/' . $fileName;
            file_put_contents($path,$decoded);

            $user->image()->create([
                'url' => 'avatar/'.$fileName
            ]);
        } else {
            $user->image()->create([
                'url' => 'avatar/default.png'
            ]);
        }
        return response()->json(new UserResource($user), 201);
    }

    public function show(User $user)
    {
        return response()->json(new UserResource($user), 200);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data_birthday = $request->input('birthday');
        $birthday = Carbon::parse($data_birthday);
        $userDB = $this->user->find($request->input('id'));
        $userDB->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'birthday' => $birthday,
            'gender' => $request->input('gender'),
            'phonenumber' => $request->input('phonenumber'),
            'mobile' => $request->input('mobile'),
            'active' => $request->input('active'),
        ]);

        if ($request->input('avatar') != '') {
            $exploded = explode(',', $request->avatar);
            $decoded = base64_decode($exploded[1]);

            if (Str::contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }

            $fileName = Str::random() . '.' . $extension;
            $path = public_path() . '/avatar/' . $fileName;
            file_put_contents($path,$decoded);

            $user->image()->update([
                'url' => 'avatar/'.$fileName
            ]);
        } else {
            $user->image()->update([
                'url' => 'avatar/default.png'
            ]);
        }

        return response()->json(new UserResource($userDB), 200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
