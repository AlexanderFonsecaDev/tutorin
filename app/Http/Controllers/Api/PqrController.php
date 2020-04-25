<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pqr;
use Illuminate\Http\Request;
use App\Http\Requests\PqrStoreRequest;
use App\Http\Requests\PqrUpdateRequest;
use App\Http\Resources\Pqr as PqrResource;
use App\Http\Resources\PqrCollection;

class PqrController extends Controller
{
    protected $pqr;

    public function __construct(Pqr $pqr)
    {
        $this->pqr = $pqr;
    }

    public function index()
    {
        return response()->json(new PqrCollection(
            $this->pqr->orderBy('id','desc')->get()
        ));
    }

    public function store(PqrStoreRequest $request)
    {
        $pqr = $this->pqr->create($request->all());
        return response()->json(new PqrResource($pqr), 201);
    }

    public function show(Pqr $pqr)
    {
        return response()->json(new PqrResource($pqr), 200);
    }

    public function update(PqrUpdateRequest $request, $id)
    {
        $pqr = $this->pqr->find($id);
        $pqr->update($request->all());
        return response()->json(new PqrResource($pqr), 200);
    }

    public function destroy(Pqr $pqr)
    {
        $pqr->delete();
        return response()->json(null, 204);
    }
}
