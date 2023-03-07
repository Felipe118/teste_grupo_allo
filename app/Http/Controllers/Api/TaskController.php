<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Repository\TaskRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected TaskRepository $taskRepository
    ){}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return AddressResource
    */
    public function store(TaskRequest $request)
    {
       $task = $this->taskRepository->storeTask($request->all());
       
       return new TaskResource($task);
    }
}
