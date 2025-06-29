<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HeroSliderResource extends JsonResource
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
            "id" => $this->id,
            "image" => asset($this->banner_image),
            "title" => $this->title,
            "subtitle" => $this->sub_title,
            "description" => $this->content,
            "buttonText" => $this->button_text,
            "buttonLink" => $this->button_url,
            "freshProductText" => "2500+ Fresh Products"
        ];
    }
}
