<?php

namespace App\Repository;

use App\Models\Task;
use Carbon\Carbon;


class TaskRepository
{
    public function __construct(
        protected Task $task,
    ){}

    public function storeTask(array $data)
    {
        $status = isset($data['status']) ? $data['status'] : 'created';
        $user = auth()->user();
        $task = $this->task->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $status,
            'user_id' => $user->id,
        ]);

        return $task;
    }

    public function get(int $id) 
    {
        $task = $this->task->findOrFail($id);

        return $task;
    }

    public function update(array $data, $id)
    {
        $task = $this->task->findOrFail($id);
     
        $task->update($data);
        return $task;
    }

    public function getTaskConclued()
    {
        $user = auth()->user();

        $tasks = $this->task->where('user_id',$user->id)->where('status','conclued')->with('user')->get();
      
        return $tasks;
    }

    public function updateTaskConclued(array $data, $id)
    {
        $task = $this->task->findOrFail($id);
        $task->completion_date = Carbon::now();

        $task->update($data);

        return $task;
    }

    public function myTasks()
    {
        $user = auth()->user();

        $tasks = $this->task->where('user_id',$user->id)->with('user')->get();
      
        return $tasks;
    }

    public function delete(int $id)
    {
        $task = $this->task->findOrFail($id);
        $user = auth()->user();
    
        if($task->user_id != $user->id){
            return response()->json(['message' => 'Não é possível excluir a tarefa de outro usuario'], 200);
        }
        
        $task->delete();
        return response()->json(['message' => 'Tarefa deletada com sucesso'], 200);
    }
}