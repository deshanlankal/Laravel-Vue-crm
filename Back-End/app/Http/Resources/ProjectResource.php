<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);

        return [
            "id"=> $this->id,
            'project_name' => $this->project_name,
            'project_description' => $this->project_description,
            'created_at'=> $this->created_at->format('Y-m-d H:i:s')
            ];
    }
}
