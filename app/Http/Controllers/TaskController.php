<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use App\Repositories\TaskRepository;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $today = Carbon::today();

        $tasks_for_user = $this->tasks->forUser($request->user());

        $tasks_today = [];
        $tasks_past = [];
        $tasks_future = [];

        $today = Carbon::today()->format('Y-m-d');

        foreach($tasks_for_user as $task) {
            $deadline = $task->deadline->format('Y-m-d');

            // var_dump($task->deadline);

            if ($deadline == $today) {
                $tasks_today[] = $task;
            } else if ($deadline < $today) {
                $tasks_past[] = $task;
            } else {
                $tasks_future[] = $task;
            }
        }

        return view('tasks.index', [
            'tasks_today' => $tasks_today,
            'tasks_past' => $tasks_past,
            'tasks_future' => $tasks_future,
        ]);
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'deadline' => 'required|date-format:"d-m-Y"'
        ]);

        // Log::info('Showing user profile for user: '.strtotime($request->deadline));

        // The slash in the createFromFormat ensures that unknown fields are set to 0
        // see http://php.net/manual/en/datetime.createfromformat.php
        $request->user()->tasks()->create([
            'name' => $request->name,
            'deadline' => Carbon::createFromFormat('d-m-Y|', $request->deadline),
        ]);

        return redirect('/tasks');
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
