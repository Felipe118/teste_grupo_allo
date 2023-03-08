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

     /**
     * Display the specified resource. 
     *
     * @param  int  $id
     * @return TaskResource
     */
    public function show($id)
    {
        $task = $this->taskRepository->get($id);  
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\TaskRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        $task = $this->taskRepository->update($request->all(),$id);
 
        return new TaskResource($task);
    }

    /**
     * brings all the tasks of the logged in user
     *
     * @return  App\Http\Resource\TaskResource
     */
    public function myTasks()
    {
        $tasks = $this->taskRepository->myTasks();
        
        return TaskResource::collection($tasks);
    }

     /**
     * brings all the tasks of the logged in user
     *
     * @return  App\Http\Resource\TaskResource
     */
    public function getTaskConclued()
    {
        $tasks = $this->taskRepository->getTaskConclued();

        if(count($tasks) == 0){
           return response()->json(['message' => 'Nenhuma tarefa foi marcada como concluída']);
        }
        
        return TaskResource::collection($tasks);
       
    }

    /**
     * mark task completed.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function markTaskConclued(Request $request, $id)
    {
        $task = $this->taskRepository->updateTaskConclued($request->all(),$id);
 
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage. 
     *
     * @param  int  $id
     * @return string $task
     */
    public function destroy($id)
    {
        $task = $this->taskRepository->delete($id);

        return $task;
    }

    

}
