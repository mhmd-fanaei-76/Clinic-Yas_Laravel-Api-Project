<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowTimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'doctor_id' => $this->users->id,
            'doctor_name' => $this->users->full_name,
            'section_id' => $this->users->section_id,
            'section_name' => $this->sections->section_name,
            'day' => $this->day,
            'start_hour' => $this->start_hours,
            'end_hour' => $this->end_hours,
            'time_id' => $this->id
        ];
    }
}
