<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Http\Resources\Tag as TagResource;
use App\Http\Resources\TagCollection;

class TagController extends Controller
{
    protected $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function index()
    {
        return response()->json(new TagCollection(
            $this->tag->orderBy('id','desc')->get()
        ));
    }

    public function store(TagStoreRequest $request)
    {
        $tag = $this->tag->create($request->all());
        return response()->json(new TagResource($tag), 201);
    }

    public function show(Tag $tag)
    {
        return response()->json(new TagResource($tag), 200);
    }

    public function update(TagUpdateRequest $request, $id)
    {
        $tag = $this->tag->find($id);
        $tag->update($request->all());
        return response()->json(new TagResource($tag), 200);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->json(null, 204);
    }
}
