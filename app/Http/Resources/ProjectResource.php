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
        $requestsOnlyLatestTime = $request->query('latestTime', false);

        return [
            'id' => $this->id,
            'name' => $this->name,
            $requestsOnlyLatestTime ? 'time' : 'times' => $this->whenLoaded('times', function() use ($requestsOnlyLatestTime) {
                if($requestsOnlyLatestTime) {
                    return new TimeResource(count($this->times) ? $this->times[0] : null);
                }else {
                    return TimeResource::collection($this->times);
                }
            }),
            'total_time' => $this->whenLoaded('times', function() {
                $addTimesAction = resolve(AddTimesAction::class);

                return $addTimesAction->handle($this->times()->pluck('time_spent')->toArray());
            }),
        ];
    }
}
