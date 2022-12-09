<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'ID' => $this->ID,
          'group_id' => $this->group_id,
          'category_id' => $this->category_id,
          'subcat_id' => $this->subcat_id,
          'user_id' => $this->user_id,
          'description' => $this->description,
          'tr_type' => $this->tr_type,
          'price' => $this->price,
          'expires_at' => $this->expires_at,
        ];
    }
}
