<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function index() {

        //Gate::authorize('viewAny', Task::class);
        return TaskResource::collection(Task::latest()->get());
        return TaskResource::collection(auth()->user()->tasks()->latest()->get());
    }

    public function show(Task $task) {

        if (Gate::denies('view', $task)) {
            return response()->json([
                'message' => 'Not Authorized'
            ], Response::HTTP_UNAUTHORIZED);
        }
        Gate::authorize('view', $task);
        return TaskResource::make($task);
    }

    public function store(StoreTaskRequest $request) {

       /* if (Gate::denies('create', Task::class)) {
            return response()->json([
                'message' => 'Not Authorized'
            ], Response::HTTP_UNAUTHORIZED);
            //abort(403, 'Not Authorized');
        }*/
        //$task = $request->user()->tasks()->create($request->validated());
        $task = Task::create($request->validated());
        return TaskResource::make($task);
    }

    public function update(UpdateTaskRequest $request, $id) {

        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

      /*  if (Gate::denies('update', $task)) {
            return response()->json([
                'message' => 'Not Authorized'
            ], Response::HTTP_UNAUTHORIZED);
            //abort(403, 'Not Authorized');
        }*/

        $task->update($request->validated());

        return TaskResource::make($task);
    }

    public function destroy($id) {

        $task = Task::find($id);

        if (!$task) {
            return response()->json([
                'message' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }

       /* if (Gate::denies('delete', $task)) {
            return response()->json([
                'message' => 'Not Authorized'
            ], Response::HTTP_UNAUTHORIZED);
            //abort(403, 'Not Authorized');
        }*/

        $task->delete();

        return response()->noContent();
    }
}
