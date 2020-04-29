<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\Task as TaskResource;
use App\Http\Resources\TaskCollection;

class TaskController extends Controller
{

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index()
    {
        return response()->json(new TaskCollection(
            $this->task->orderBy('id','desc')->get()
        ));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Task $task)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Task $task)
    {
        //
    }
}
