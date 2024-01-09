<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): ?array
    {
        return $this->resource ? [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'icon_url' => env('STORAGE_BASE_URL').$this->icon,
            'description' => $this->description,
            'active' => $this->active,
        ] : null;
    }
}
