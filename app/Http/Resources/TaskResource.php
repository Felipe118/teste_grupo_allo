<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public static $wrap = 'task';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'conclued' => isset($this->completion_date) ? Carbon::make($this->completion_date)->format('d/m/Y') : '',
            'created' => Carbon::make($this->created_at)->format('d/m/Y'),
            'user' => new UserResource($this->user),
        ];
    }
}
