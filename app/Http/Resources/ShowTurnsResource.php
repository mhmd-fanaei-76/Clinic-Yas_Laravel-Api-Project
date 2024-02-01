<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowTurnsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'Patient-Name' => $this->users->full_name,
            'day' => $this->times->day,
            'hour' => $this->times->start_hours ." : " . $this->times->end_hours,
            'turn_id' => $this->id,
            'confirmation' => $this->confirmation
        ];
    }
}
