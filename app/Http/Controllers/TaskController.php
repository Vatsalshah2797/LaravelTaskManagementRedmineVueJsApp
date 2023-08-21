<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Http\Helpers\CommonTrait;


class TaskController extends Controller
{
    use CommonTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        $backend = env('DB_CONNECTION');
        $tasks = [];

        if ($backend === 'mysql') {
            $perPage = $request->input('per_page', 5);

            $tasks = Task::query();
            $tasks = $tasks->select([
                'id',
                'title',
                'description',
                'status',
                'priority',
                'due_date',
                'assignee_id',
                'project_id'
            ])
            ->with(
                [
                    'user:id,name',
                    'project:id,name'
                ]
            );

            if ($request->has('searchTerm')) {
                $searchTerm = $request->input('searchTerm');
                $tasks = $tasks->where('title', 'like', $searchTerm . '%');
            }
    
            $tasks = $tasks->latest();

            $tasks = $tasks->paginate($perPage);
        } elseif ($backend === 'redmine') {
            $tasks = $this->fetchTasksFromRedmineUsingGuzzle();
            foreach ($tasks as $key => $task) {
                $task = $task-->with(
                    [
                        'user:id,name',
                        'project:id,name'
                    ]
                );

                $tasks[] = $task;
            }
        }

        return response()->json([
            'tasks' => $tasks,
            'pagination' => [
                'current_page' => $tasks->currentPage(),
                'total_pages' => $tasks->lastPage(),
            ],
        ]);
    }

    public function getRequireData()
    {
        $backend = env('DB_CONNECTION');
        if ($backend === 'mysql') {
            $users = User::select('id', 'name')->get();
            $projects = Project::select('id', 'name')->get();
        } 
        elseif ($backend === 'redmine') {
        }
        return response()->json([
            'users' => $users,
             'projects' => $projects
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $backend = env('DB_CONNECTION');
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($backend === 'mysql') {
            $todo = Task::create($request->all());
        } elseif ($backend === 'redmine') {
            $todo = $this->createIssue($request);
        }
        return response()->json($todo);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $backend = env('DB_CONNECTION');
        if ($backend === 'mysql') {
            Task::where('id', $id)->delete();
        } elseif ($backend === 'redmine') {
            $todo = $this->deleteIssue($deleteIssue, $id);
        }
        return response()->json('Task has been deleted successfully.');
    }
}
