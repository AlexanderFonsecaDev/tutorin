<?php

namespace App\Http\Controllers\Api;

use App\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GroupStoreRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Http\Resources\Group as GroupResource;
use App\Http\Resources\GroupCollection;

class GroupController extends Controller
{
    protected $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function index()
    {
        return response()->json(new GroupCollection(
            $this->group->orderBy('id','desc')->get()
        ));
    }

    public function store(GroupStoreRequest $request)
    {
        $group = $this->group->create($request->all());
        return response()->json(new GroupResource($group), 201);
    }

    public function show(Group $group)
    {
        return response()->json(new GroupResource($group), 200);
    }

    public function update(GroupUpdateRequest $request, $id)
    {
        $group = $this->group->find($id);
        $group->update($request->all());
        return response()->json(new GroupResource($group), 200);
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return response()->json(null, 204);
    }
}
