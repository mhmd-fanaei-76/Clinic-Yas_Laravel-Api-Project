<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowTimeForAdmin extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "doctor_id" => $this->doctor_id,
            "doctor_name" => $this->users->full_name,
            "section_id" => $this->section_id,
            "section_name" =>$this->sections->section_name,
            "day" => $this->day,
            "start_hours" => $this->start_hours,
            "end_hours" => $this->end_hours,
            "confirmation" => $this->confirmation
        ];
    }
}
