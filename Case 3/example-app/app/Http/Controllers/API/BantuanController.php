<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Resources\Json\JsonResource;

class BantuanController extends JsonResource
{
    /**
     * Display a listing of the resource.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
