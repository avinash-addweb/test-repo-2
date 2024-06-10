<?php

namespace Modules\Testimonial\Http\Resources\Admin;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'email' => $this?->email??"",
            'name' => $this?->testimonialLocale?->name??"",
            'designation' => $this?->testimonialLocale?->designation??"",
            'contents' => $this?->testimonialLocale?->contents??"",
            'image' => (!empty($this->testimonialImage->name) && !empty($this->testimonialImage->path)) ? $this->testimonialImage->path.DIRECTORY_SEPARATOR.$this->testimonialImage->name : "",
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
