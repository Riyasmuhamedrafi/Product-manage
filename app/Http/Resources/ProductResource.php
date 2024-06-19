<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>$this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'status' => ($this->status == 1)?'Active': 'InActive',
            'images' => $this->find_images(),
        ];
    }
    private function find_images(){
        return $this->images->map(function ($image) {
            // Assuming images are stored in 'public/storage/images' and accessible via URL

            return asset('storage/images/'.$image->image);
            // OR if using Storage facade:
            // return Storage::url('images/' . $image->image);
        })->all();


    }
}
