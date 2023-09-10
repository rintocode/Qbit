<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Resources\Json\JsonResource;

class TentangController extends JsonResource
{
    /**
     * Display a listing of the resource.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'description' => $this->description,
        ];
    }
}
