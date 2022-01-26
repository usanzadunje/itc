<?php

namespace App\Http\Resources;

use App\Actions\AddTimesAction;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'times' => TimeResource::collection($this->whenLoaded('times')),
            'total_time' => $this->whenLoaded('times', function() {
                $addTimesAction = new AddTimesAction();

                return $addTimesAction->handle($this->times()->pluck('time_spent')->toArray());
            }),
        ];
    }
}
