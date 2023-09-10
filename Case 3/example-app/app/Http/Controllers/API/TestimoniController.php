<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Resources\Json\JsonResource;

class TestimoniController extends JsonResource
{
    /**
     * Display a listing of the resource.
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'nama' => $this->nama,
            'address' => $this->address,
            'content' => $this->content,
        ];
    }
}
