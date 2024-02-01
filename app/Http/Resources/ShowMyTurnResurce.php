<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowMyTurnResurce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'My Turn Is : ' => [
                'In Day : ' => $this->times->day,
                'With Doctor : ' => $this->times->users->full_name,
                'In Section : ' => $this->times->users->sections->section_name,
                'Confirmation' => $this->confirmation
                ]
        ];
    }
}
