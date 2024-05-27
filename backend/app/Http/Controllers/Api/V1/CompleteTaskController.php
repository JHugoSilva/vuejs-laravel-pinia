<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CompleteTaskController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Task $task)
    {
        /*if (Gate::denies('update', $task)) {
            return response()->json([
                'message' => 'Not Authorized'
            ], Response::HTTP_UNAUTHORIZED);
            //abort(403, 'Not Authorized');
        }*/
        $task->is_completed = $request->is_completed;
        $task->save();

        return TaskResource::make($task);
    }
}
